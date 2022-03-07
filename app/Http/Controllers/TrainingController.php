<?php

namespace App\Http\Controllers;

use App\Models\HcTraining;
use App\Models\MasterDivisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TrainingController extends Controller
{
    public function index()
    {
        $training = HcTraining::get();

        return view('pages.training.index', ['trainings' => $training]);
    }

    public function create()
    {
        $divisis = MasterDivisi::get();

        return response()->json([
            'divisis' => $divisis
        ]);
    }

    public function store(Request $request)
    {
        $trainings = new HcTraining;
        $trainings->kategori = $request->kategori;
        $trainings->judul = $request->judul;
        $trainings->master_divisi_id = $request->divisi_id;
        $trainings->tanggal = $request->tanggal;
        $trainings->durasi = $request->durasi;
        $trainings->peserta = $request->peserta;
        $trainings->tempat = $request->tempat;
        $trainings->goal = $request->goal;
        $trainings->pengisi = $request->pengisi;
        $trainings->jenis = $request->jenis;
        $trainings->hasil = $request->hasil;
        $trainings->status = $request->status;

        if($request->hasFile('modul')) {
            $file = $request->file('modul');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('file/', $filename);
            $trainings->modul = $filename;
        }

        $trainings->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function show($id)
    {
        $training = HcTraining::find($id);

        return response()->json([
            'training' => $training
        ]);
    }

    public function edit($id)
    {
        $training = HcTraining::find($id);
        $divisis = MasterDivisi::get();

        return response()->json([
            'training' => $training,
            'divisis' => $divisis
        ]);
    }

    public function update(Request $request)
    {
        $training = HcTraining::find($request->id);
        $training->kategori = $request->kategori;
        $training->judul = $request->judul;
        $training->master_divisi_id = $request->divisi_id;
        $training->tanggal = $request->tanggal;
        $training->durasi = $request->durasi;
        $training->peserta = $request->peserta;
        $training->tempat = $request->tempat;
        $training->goal = $request->goal;
        $training->pengisi = $request->pengisi;
        $training->jenis = $request->jenis;
        $training->hasil = $request->hasil;
        $training->status = $request->status;

        if($request->hasFile('modul')) {
            if (file_exists(public_path("file/" . $training->modul))) {
                File::delete(public_path("file/" . $training->modul));
            }
            $file = $request->file('modul');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('file/', $filename);
            $training->modul = $filename;
        }

        $training->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $training = HcTraining::find($id);

        return response()->json([
            'id' => $training->id
        ]);
    }

    public function delete(Request $request)
    {
        $training = HcTraining::find($request->id);
        if (file_exists(public_path("file/" . $training->modul))) {
            File::delete(public_path("file/" . $training->modul));
        }
        $training->delete();

        return response()->json([
            'status' => $request->id
        ]);
    }

    public function modul(Request $request, $file_modul)
    {
        return response()->download(public_path('file/'. $file_modul));
    }
}
