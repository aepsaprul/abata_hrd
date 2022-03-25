<?php

namespace App\Http\Controllers;

use App\Models\HcLoker;
use App\Models\MasterJabatan;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    public function index()
    {
        $loker = HcLoker::get();

        return view('pages.master.loker.index', ['lokers' => $loker]);
    }

    public function create()
    {
        $jabatan = MasterJabatan::doesntHave('loker')->get();

        return response()->json([
            'jabatans' => $jabatan
        ]);
    }

    public function store(Request $request)
    {
        $loker = new HcLoker;
        $loker->master_jabatan_id = $request->jabatan_id;
        $loker->save();

        activity_log($loker, "loker", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $loker = HcLoker::find($id);

        $jabatan = MasterJabatan::get();

        return response()->json([
            'id' => $loker->id,
            'jabatan_id' => $loker->master_jabatan_id,
            'jabatans' => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $loker = HcLoker::find($id);
        $loker->master_jabatan_id = $request->jabatan_id;
        $loker->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $loker = HcLoker::find($id);

        return response()->json([
            'id' => $loker->id
        ]);
    }

    public function delete(Request $request)
    {
        $loker = HcLoker::find($request->id);
        $loker->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
