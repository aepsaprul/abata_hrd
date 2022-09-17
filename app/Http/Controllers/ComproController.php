<?php

namespace App\Http\Controllers;

use App\Models\ComproTentang;
use Illuminate\Http\Request;

class ComproController extends Controller
{
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
}
