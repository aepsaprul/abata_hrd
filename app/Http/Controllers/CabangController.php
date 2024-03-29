<?php

namespace App\Http\Controllers;

use App\Models\MasterCabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = MasterCabang::get();

        return view('pages.master.cabang.index', ['cabangs' => $cabang]);
    }

    public function store(Request $request)
    {
        $cabang = new MasterCabang;
        $cabang->nama_cabang = $request->nama;
        $cabang->alias = $request->alias;
        $cabang->save();

        // activity_log($cabang, "cabang", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $cabang = MasterCabang::find($id);

        return response()->json([
            'id' => $cabang->id,
            'cabang' => $cabang
        ]);
    }

    public function update(Request $request, $id)
    {
        $cabang = MasterCabang::find($id);
        $cabang->nama_cabang = $request->nama;
        $cabang->alias = $request->alias;
        $cabang->save();

        // activity_log($cabang, "cabang", "updated");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $cabang = MasterCabang::find($id);

        return response()->json([
            'id' => $cabang->id
        ]);
    }

    public function delete(Request $request)
    {
        $cabang = MasterCabang::find($request->id);
        $cabang->delete();

        // activity_log($cabang, "cabang", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
