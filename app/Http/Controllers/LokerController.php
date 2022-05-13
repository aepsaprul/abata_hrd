<?php

namespace App\Http\Controllers;

use App\Models\LokerData;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LokerController extends Controller
{
    public function index()
    {
        $loker = LokerData::get();

        return view('pages.master.loker.index', ['lokers' => $loker]);
    }

    public function create()
    {
        $cabang = MasterCabang::get();
        $jabatan = MasterJabatan::doesntHave('loker')->get();

        return response()->json([
            'cabangs' => $cabang,
            'jabatans' => $jabatan
        ]);
    }

    public function store(Request $request)
    {
        $loker = new LokerData;
        $loker->cabang_id = $request->create_cabang_id;
        $loker->lokasi = $request->create_lokasi;
        $loker->jabatan_id = $request->create_jabatan_id;
        $loker->publish = 'y';

        if($request->hasFile('create_img')) {
            $file = $request->file('create_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/file/loker/', $filename);
            $loker->image = $filename;
        }

        $loker->save();

        activity_log($loker, "loker", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function show($id)
    {
        $loker = LokerData::find($id);

        return response()->json([
            'loker' => $loker
        ]);
    }

    public function edit($id)
    {
        $loker = LokerData::find($id);
        $cabang = MasterCabang::get();
        $jabatan = MasterJabatan::doesntHave('loker')->get();

        return response()->json([
            'loker' => $loker,
            'jabatans' => $jabatan,
            'cabangs' => $cabang
        ]);
    }

    public function update(Request $request)
    {
        $loker = LokerData::find($request->edit_id);
        $loker->cabang_id = $request->edit_cabang_id;
        $loker->lokasi = $request->edit_lokasi;
        $loker->jabatan_id = $request->edit_jabatan_id;

        if($request->hasFile('edit_img')) {
            if (file_exists("public/file/loker/" . $loker->image)) {
                File::delete("public/file/loker/" . $loker->image);
            }
            $file = $request->file('edit_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/file/loker/', $filename);
            $loker->image = $filename;
        }

        $loker->save();

        activity_log($loker, "loker", "updated");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $loker = LokerData::find($id);

        return response()->json([
            'id' => $loker->id
        ]);
    }

    public function delete(Request $request)
    {
        $loker = LokerData::find($request->id);
        $loker->delete();

        activity_log($loker, "loker", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function publish(Request $request, $id)
    {
        $loker = LokerData::find($id);
        $loker->publish = $request->show;
        $loker->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
