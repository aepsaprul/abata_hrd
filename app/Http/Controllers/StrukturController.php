<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
  public function index()
  {
    $strukturs = Struktur::get();

    return view('pages.struktur_organisasi.index', ['strukturs' => $strukturs]);
  }

  public function create()
  {
    $strukturs = Struktur::get();

    return view('pages.struktur_organisasi.create', ['strukturs' => $strukturs]);
  }

  public function store(Request $request)
  {
    $struktur = new Struktur;
    $struktur->nama = $request->nama;
    $struktur->title = $request->title;
    $struktur->parent_id = $request->parent_id;
    $struktur->save();

    return redirect()->route('struktur')->with('message', 'Data berhasil disimpan');
  }

  public function edit($id)
  {
    $struktur = Struktur::find($id);
    $strukturs = Struktur::get();
    
    return view('pages.struktur_organisasi.edit', [
      'struktur' => $struktur,
      'strukturs' => $strukturs
    ]);
  }

  public function update(Request $request, $id)
  {
    $struktur = Struktur::find($id);
    $struktur->nama = $request->nama;
    $struktur->title = $request->title;
    $struktur->parent_id = $request->parent_id;
    $struktur->save();

    return redirect()->route('struktur')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $struktur = Struktur::find($id);
    $struktur->delete();

    return redirect()->route('struktur')->with('message', 'Data berhasil dihapus');
  }

  public function display()
  {
    return view('pages.struktur_organisasi.show');
  }

  public function getStruktur() {
    $struktur = Struktur::all();
    return response()->json($this->buildTree($struktur));
  }

  private function buildTree($elements, $parentId = null) {
    $colors = ['#FF5733', '#33FF57', '#5733FF', '#FFC300', '#C70039', '#900C3F']; // Warna background acak
    $branch = [];
    foreach ($elements as $index => $element) {
        if ($element->parent_id == $parentId) {
            $children = $this->buildTree($elements, $element->id);
            $branch[] = [
                'id' => $element->id,
                'name' => $element->nama,
                'title' => $element->title,
                'color' => $colors[$index % count($colors)], // Atur warna secara acak dari array
                'children' => $children,
            ];
        }
    }
    return $branch;
  }
}
