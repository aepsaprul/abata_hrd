<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = MasterJabatan::get();

        return view('pages.master.jabatan.index', ['jabatans' => $jabatan]);
    }

    public function store(Request $request)
    {
        $jabatan = new MasterJabatan;
        $jabatan->nama_jabatan = $request->nama;
        $jabatan->save();

        activity_log($jabatan, "jabatan", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $jabatan = MasterJabatan::find($id);

        return response()->json([
            'id' => $jabatan->id,
            'nama' => $jabatan->nama_jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $jabatan = MasterJabatan::find($id);
        $jabatan->nama_jabatan = $request->nama;
        $jabatan->save();

        activity_log($jabatan, "jabatan", "updated");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $jabatan = MasterJabatan::find($id);

        return response()->json([
            'id' => $jabatan->id
        ]);
    }

    public function delete(Request $request)
    {
        $jabatan = MasterJabatan::find($request->id);
        $jabatan->delete();

        activity_log($jabatan, "jabatan", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
