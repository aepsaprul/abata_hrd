<?php

namespace App\Http\Controllers;

use App\Models\ComproCabang;
use App\Models\ComproKontak;
use App\Models\ComproTentang;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class ComproController extends Controller
{
    // tentang
    public function tentang()
    {
        $tentang = ComproTentang::get();

        return view('pages.compro.tentang.index', [
            'tentangs' => $tentang
        ]);
    }
    
    public function tentangStore(Request $request)
    {
        $tentang = new ComproTentang;
        $tentang->nama = $request->create_nama;
        $tentang->deskripsi = $request->create_deskripsi;
        $tentang->grup = $request->create_grup;
        $tentang->save();

        return redirect()->route('compro.tentang');
    }

    public function tentangEdit($id)
    {
        $tentang = ComproTentang::find($id);

        return view('pages.compro.tentang.edit', ['tentang' => $tentang]);
    }

    public function tentangUpdate(Request $request)
    {
        $tentang = ComproTentang::find($request->edit_id);
        $tentang->nama = $request->edit_nama;
        $tentang->deskripsi = $request->edit_deskripsi;
        $tentang->grup = $request->edit_grup;
        $tentang->save();

        return redirect()->route('compro.tentang');
    }

    public function tentangDelete(Request $request)
    {
        $tentang = ComproTentang::find($request->id);
        $tentang->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    // kontak
    public function kontak()
    {
        $kontak = ComproKontak::get();

        return view('pages.compro.kontak.index', ['kontaks' => $kontak]);
    }

    public function kontakStore(Request $request)
    {
        $kontak = new ComproKontak;
        $kontak->img = $request->create_img;
        $kontak->nomor = $request->create_nomor;
        $kontak->link = $request->create_link;
        $kontak->grup = $request->create_grup;
        $kontak->save();

        return redirect()->route('compro.kontak');
    }

    public function kontakEdit($id)
    {
        $kontak = ComproKontak::find($id);

        return view('pages.compro.kontak.edit', ['kontak' => $kontak]);
    }

    public function kontakUpdate(Request $request)
    {
        $kontak = ComproKontak::find($request->edit_id);
        $kontak->img = $request->edit_img;
        $kontak->nomor = $request->edit_nomor;
        $kontak->link = $request->edit_link;
        $kontak->grup = $request->edit_grup;
        $kontak->save();

        return redirect()->route('compro.kontak');
    }

    public function kontakDelete(Request $request)
    {
        $kontak = ComproKontak::find($request->id);
        $kontak->delete();

        return redirect()->route('compro.kontak');
    }

    // cabang
    public function cabang()
    {
        $cabang = ComproCabang::get();

        return view('pages.compro.cabang.index', ['cabangs' => $cabang]);
    }

    public function cabangStore(Request $request)
    {
        $cabang = new ComproCabang;
        $cabang->grup = $request->create_grup;
        $cabang->nama = $request->create_nama;
        $cabang->alamat = $request->create_alamat;
        $cabang->kontak = $request->create_kontak;
        $cabang->maps = $request->create_maps;
        $cabang->save();

        return redirect()->route('compro.cabang');
    }

    public function cabangEdit($id)
    {
        $cabang = ComproCabang::find($id);

        return view('pages.compro.cabang.edit', ['cabang' => $cabang]);
    }

    public function cabangUpdate(Request $request)
    {
        $cabang = ComproCabang::find($request->edit_id);
        $cabang->grup = $request->edit_grup;
        $cabang->nama = $request->edit_nama;
        $cabang->alamat = $request->edit_alamat;
        $cabang->kontak = $request->edit_kontak;
        $cabang->maps = $request->edit_maps;
        $cabang->save();

        return redirect()->route('compro.cabang');
    }

    public function cabangDelete(Request $request)
    {
        $cabang = ComproCabang::find($request->id);
        $cabang->delete();

        return redirect()->route('compro.cabang');
    }
}
