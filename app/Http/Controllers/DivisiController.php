<?php

namespace App\Http\Controllers;

use App\Models\MasterDivisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = MasterDivisi::get();

        return view('pages.master.divisi.index', ['divisis' => $divisi]);
    }

    public function store(Request $request)
    {
        $divisi = new MasterDivisi;
        $divisi->nama = $request->nama;
        $divisi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $divisi = MasterDivisi::find($id);

        return response()->json([
            'id' => $divisi->id,
            'nama' => $divisi->nama
        ]);
    }

    public function update(Request $request, $id)
    {
        $divisi = MasterDivisi::find($id);
        $divisi->nama = $request->nama;
        $divisi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $divisi = MasterDivisi::find($id);

        return response()->json([
            'id' => $divisi->id
        ]);
    }

    public function delete(Request $request)
    {
        $divisi = MasterDivisi::find($request->id);
        $divisi->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
