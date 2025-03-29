<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTraining;
use App\Models\HcTraining;
use App\Models\MasterDivisi;
use App\Models\MasterKaryawan;
use App\Models\Materi;
use App\Models\Modul;
use App\Models\Training;
use App\Models\TrainingModul;
use App\Models\TrainingPengisi;
use App\Models\TrainingPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
  public function index()
  {
    if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
      $training = Training::orderBy('id', 'desc')->limit(500)->get();
    } else {
      $training = Training::whereHas('dataPeserta', function($q) {
        $q->where('karyawan_id', Auth::user()->master_karyawan_id);
      })->get();
    }
    
    return view('pages.training.index', ['trainings' => $training]);
  }

  public function create()
  {
    $divisi = MasterDivisi::get();

    return view('pages.training.create', ['divisis' => $divisi]);
  }

  public function store(Request $request)
  {
    $training = new Training;
    $training->kategori = $request->kategori;
    $training->judul = $request->judul;
    $training->divisi_id = $request->divisi_id;
    $training->tanggal = $request->tanggal;
    $training->durasi = $request->durasi;
    $training->tempat = $request->tempat;
    $training->goal = $request->goal;
    $training->jenis = $request->jenis;
    $training->hasil = $request->hasil;
    $training->save();

    foreach ($request->peserta as $key => $val) {
      $peserta = new TrainingPeserta;
      $peserta->training_id = $training->id;
      $peserta->master_karyawan_id = $val;
      $peserta->save();
    }

    foreach ($request->pengisi as $key => $val) {
      $pengisi = new TrainingPengisi;
      $pengisi->training_id = $training->id;
      $pengisi->karyawan_id = $val;
      $pengisi->save();
    }

    foreach ($request->modul as $key => $val) {
      $modul = new TrainingModul;
      $modul->training_id = $training->id;
      $modul->modul_id = $val;
      $modul->save();
    }
    
    return redirect()->route('training')->with('message', 'Data berhasil ditambahkan.');
  }

  public function show($id)
  {
    $training = Training::find($id);
    $training_peserta = TrainingPeserta::where('training_id', $training->id)->get();
    $training_pengisi = TrainingPengisi::where('training_id', $training->id)->get();
    $training_modul = TrainingModul::where('training_id', $training->id)->get();
    $divisi = MasterDivisi::get();
    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();
    $modul = Modul::get();
    
    return view('pages.training.show', [
      'training' => $training,
      'divisis' => $divisi,
      'karyawans' => $karyawan,
      'moduls' => $modul,
      'training_pesertas' => $training_peserta,
      'training_pengisis' => $training_pengisi,
      'training_moduls' => $training_modul
    ]);
  }

  public function edit($id)
  {
    $training = Training::find($id);
    $training_peserta = TrainingPeserta::where('training_id', $training->id)->get();
    $training_pengisi = TrainingPengisi::where('training_id', $training->id)->get();
    $training_modul = TrainingModul::where('training_id', $training->id)->get();
    $divisi = MasterDivisi::get();
    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();
    $modul = Modul::get();

    return view('pages.training.edit', [
      'training' => $training,
      'divisis' => $divisi,
      'karyawans' => $karyawan,
      'moduls' => $modul,
      'training_pesertas' => $training_peserta,
      'training_pengisis' => $training_pengisi,
      'training_moduls' => $training_modul
    ]);
  }

  public function update(Request $request, $id)
  {
    $training = Training::find($id);
    $training->kategori = $request->kategori;
    $training->judul = $request->judul;
    $training->divisi_id = $request->divisi_id;
    $training->tanggal = $request->tanggal;
    $training->durasi = $request->durasi;
    $training->tempat = $request->tempat;
    $training->goal = $request->goal;
    $training->jenis = $request->jenis;
    $training->hasil = $request->hasil;
    $training->save();

    $training_peserta = TrainingPeserta::where('training_id', $training->id);
    if ($training_peserta) {
      $training_peserta->delete();
    }
    $training_pengisi = TrainingPengisi::where('training_id', $training->id);
    if ($training_pengisi) {
      $training_pengisi->delete();
    }
    $training_modul = TrainingModul::where('training_id', $training->id);
    if ($training_modul) {
      $training_modul->delete();
    }

    foreach ($request->peserta as $key => $val) {
      $peserta = new TrainingPeserta;
      $peserta->training_id = $training->id;
      $peserta->karyawan_id = $val;
      $peserta->save();
    }

    foreach ($request->pengisi as $key => $val) {
      $pengisi = new TrainingPengisi;
      $pengisi->training_id = $training->id;
      $pengisi->karyawan_id = $val;
      $pengisi->save();
    }

    foreach ($request->modul as $key => $val) {
      $modul = new TrainingModul;
      $modul->training_id = $training->id;
      $modul->modul_id = $val;
      $modul->save();
    }
    
    return redirect()->route('training')->with('message', 'Data berhasil diperbaharui.');
  }

  public function delete($id)
  {
    $training = Training::find($id);

    $training_peserta = TrainingPeserta::where('training_id', $training->id);
    if ($training_peserta) {
      $training_peserta->delete();
    }
    $training_pengisi = TrainingPengisi::where('training_id', $training->id);
    if ($training_pengisi) {
      $training_pengisi->delete();
    }
    $training_modul = TrainingModul::where('training_id', $training->id);
    if ($training_modul) {
      $training_modul->delete();
    }

    $training->delete();

    return redirect()->route('training')->with('message', 'Data berhasil dihapus.');
  }

  public function laporan(Request $request)
  {
    $tahun = $request->tahun;
    $bulan = $request->bulan;

    return Excel::download(new LaporanTraining($tahun, $bulan), 'laporan.xlsx');
  }

  public function getKaryawan()
  {
    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

    return response()->json([
      'data' => $karyawan
    ]);
  }

  public function getModul()
  {
    $modul = Modul::get();

    return response()->json([
      'data' => $modul
    ]);
  }

  // modul
  public function moduls()
  {
    $moduls = Modul::get();

    return view('pages.training.modul', ['moduls' => $moduls]);
  }

  public function modulCreate()
  {
    return view('pages.training.modulCreate');
  }

  public function modulStore(Request $request)
  {
    $modul = new Modul;
    $modul->nama = $request->nama;
    
    // file
    if($request->hasFile('file')) {
      $file = $request->file('file');
      $extension = $file->getClientOriginalExtension();
      $filename = time() . "." . $extension;
      $file->move(env('APP_URL_IMG') . 'file_modul/', $filename);
      $modul->file = $filename;
    }

    $modul->save();

    return redirect()->route('training.moduls')->with('message', 'Data berhasil ditambahkan.');
  }

  public function modulEdit($id)
  {
    $modul = Modul::find($id);
    
    return view('pages.training.modulEdit', ['modul' => $modul]);
  }

  public function modulUpdate(Request $request, $id)
  {
    $modul = Modul::find($id);
    $modul->nama = $request->nama;

    // file
    if($request->hasFile('file')) {
      if (file_exists(env('APP_URL_IMG') . 'file_modul/' . $modul->file)) {
        File::delete(env('APP_URL_IMG') . 'file_modul/' . $modul->file);
      }

      $file = $request->file('file');
      $extension = $file->getClientOriginalExtension();
      $filename = time() . "." . $extension;
      $file->move(env('APP_URL_IMG') . 'file_modul/', $filename);
      $modul->file = $filename;
    }

    $modul->save();

    return redirect()->route('training.moduls')->with('message', 'Data berhasil diperbaharui.');
  }

  public function modulDelete($id)
  {
    $modul = Modul::find($id);

    // file
    if (file_exists(env('APP_URL_IMG') . 'file_modul/' . $modul->file)) {
      File::delete(env('APP_URL_IMG') . 'file_modul/' . $modul->file);
    }

    $modul->delete();

    return redirect()->route('training.moduls')->with('message', 'Data berhasil dihapus.');
  }

  // materi
  public function materi($id)
  {
    $modul = Modul::find($id);
    $materis = Materi::where('modul_id', $id)->get();

    return view('pages.training.materi', [
      'modul' => $modul,
      'materis' => $materis
    ]);
  }

  public function materiStore(Request $request)
  {
    $materi = new Materi;
    $materi->nama = $request->nama;
    $materi->modul_id = $request->modul_id;
    $materi->save();

    return response()->json([
      'status' => 200,
      'message' => 'success'
    ]);
  }

  public function materiEdit($id)
  {
    $materi = Materi::find($id);
    
    return response()->json([
      'materi' => $materi
    ]);
  }

  public function materiUpdate(Request $request, $id)
  {
    $materi = Materi::find($id);
    $materi->nama = $request->nama;
    $materi->save();

    return response()->json([
      'status' => 200,
      'message' => 'success'
    ]);
  }

  public function materiDelete($id)
  {
    $materi = Materi::find($id);
    $materi->delete();

    return response()->json([
      'status' => 200,
      'message' => 'success'
    ]);
  }
}