<?php

namespace App\Http\Controllers;

use App\Models\HcTraining;
use App\Models\MasterDivisi;
use App\Models\MasterKaryawan;
use App\Models\Modul;
use App\Models\Training;
use App\Models\TrainingModul;
use App\Models\TrainingPengisi;
use App\Models\TrainingPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TrainingController extends Controller
{
  public function index()
  {
    // $training = HcTraining::get();

    // return view('pages.training.index', ['trainings' => $training]);
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

  // public function create()
  // {
  //     $divisis = MasterDivisi::get();

  //     return response()->json([
  //         'divisis' => $divisis
  //     ]);
  // }

  // public function store(Request $request)
  // {
  //     $trainings = new HcTraining;
  //     $trainings->kategori = $request->kategori;
  //     $trainings->judul = $request->judul;
  //     $trainings->master_divisi_id = $request->divisi_id;
  //     $trainings->tanggal = $request->tanggal;
  //     $trainings->durasi = $request->durasi;
  //     $trainings->peserta = $request->peserta;
  //     $trainings->tempat = $request->tempat;
  //     $trainings->goal = $request->goal;
  //     $trainings->pengisi = $request->pengisi;
  //     $trainings->jenis = $request->jenis;
  //     $trainings->hasil = $request->hasil;
  //     $trainings->status = $request->status;

  //     // dev
  //     if($request->hasFile('modul')) {
  //         $file = $request->file('modul');
  //         $extension = $file->getClientOriginalExtension();
  //         $filename = time() . "." . $extension;
  //         $file->move('public/file/modul/', $filename);
  //         $trainings->modul = $filename;
  //     }
  //     // prod
  //     // if($request->hasFile('modul')) {
  //     //   $file = $request->file('modul');
  //     //   $extension = $file->getClientOriginalExtension();
  //     //   $filename = time() . "." . $extension;
  //     //   $file->move('file/modul/', $filename);
  //     //   $trainings->modul = $filename;
  //     // }

  //     $trainings->save();

  //     activity_log($trainings, "training", "created");

  //     return response()->json([
  //         'status' => 'true'
  //     ]);
  // }

  // public function show($id)
  // {
  //     $training = HcTraining::find($id);
  //     $divisi = MasterDivisi::get();

  //     return response()->json([
  //         'training' => $training,
  //         'divisis' => $divisi
  //     ]);
  // }

  // public function edit($id)
  // {
  //     $training = HcTraining::find($id);
  //     $divisis = MasterDivisi::get();

  //     return response()->json([
  //         'training' => $training,
  //         'divisis' => $divisis
  //     ]);
  // }

  // public function update(Request $request)
  // {
  //     $training = HcTraining::find($request->id);
  //     $training->kategori = $request->kategori;
  //     $training->judul = $request->judul;
  //     $training->master_divisi_id = $request->divisi_id;
  //     $training->tanggal = $request->tanggal;
  //     $training->durasi = $request->durasi;
  //     $training->peserta = $request->peserta;
  //     $training->tempat = $request->tempat;
  //     $training->goal = $request->goal;
  //     $training->pengisi = $request->pengisi;
  //     $training->jenis = $request->jenis;
  //     $training->hasil = $request->hasil;
  //     $training->status = $request->status;

  //     // dev
  //     if($request->hasFile('modul')) {
  //         if (file_exists(public_path("file/modul/" . $training->modul))) {
  //             File::delete(public_path("file/modul/" . $training->modul));
  //         }
  //         $file = $request->file('modul');
  //         $extension = $file->getClientOriginalExtension();
  //         $filename = time() . "." . $extension;
  //         $file->move('public/file/modul/', $filename);
  //         $training->modul = $filename;
  //     }
  //     // prod
  //     // if($request->hasFile('modul')) {
  //     //   if (file_exists(public_path("file/modul/" . $training->modul))) {
  //     //       File::delete(public_path("file/modul/" . $training->modul));
  //     //   }
  //     //   $file = $request->file('modul');
  //     //   $extension = $file->getClientOriginalExtension();
  //     //   $filename = time() . "." . $extension;
  //     //   $file->move('file/modul/', $filename);
  //     //   $training->modul = $filename;
  //     // }

  //     $training->save();

  //     activity_log($training, "training", "updated");

  //     return response()->json([
  //         'status' => 'true'
  //     ]);
  // }

  // public function deleteBtn($id)
  // {
  //     $training = HcTraining::find($id);

  //     return response()->json([
  //         'id' => $training->id
  //     ]);
  // }

  // public function delete(Request $request)
  // {
  //     $training = HcTraining::find($request->id);

  //     // dev
  //     // if (file_exists("public/file/modul/" . $training->modul)) {
  //     //     File::delete("public/file/modul/" . $training->modul);
  //     // }
  //     // prod
  //     if (file_exists("file/modul/" . $training->modul)) {
  //       File::delete("file/modul/" . $training->modul);
  //     }

  //     $training->delete();

  //     activity_log($training, "training", "deleted");

  //     return response()->json([
  //         'status' => $request->id
  //     ]);
  // }

  // public function modul(Request $request, $file_modul)
  // {
  //     return response()->download(public_path('file/modul/'. $file_modul));
  // }

  // public function training()
  // {
  //   if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
  //     $training = Training::orderBy('id', 'desc')->limit(500)->get();
  //   } else {
  //     $training = Training::whereHas('dataPeserta', function($q) {
  //       $q->where('karyawan_id', Auth::user()->master_karyawan_id);
  //     })->get();
  //   }

  //   return view('pages.training.training', ['trainings' => $training]);
  // }

  // public function trainingCreate()
  // {
  //   $divisi = MasterDivisi::get();

  //   return view('pages.training.create', ['divisis' => $divisi]);
  // }

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

  // public function trainingStore(Request $request)
  // {
  //   $training = new Training;
  //   $training->kategori = $request->kategori;
  //   $training->judul = $request->judul;
  //   $training->divisi_id = $request->divisi_id;
  //   $training->tanggal = $request->tanggal;
  //   $training->durasi = $request->durasi;
  //   $training->tempat = $request->tempat;
  //   $training->goal = $request->goal;
  //   $training->jenis = $request->jenis;
  //   $training->hasil = $request->hasil;
  //   $training->save();

  //   foreach ($request->peserta as $key => $val) {
  //     $peserta = new TrainingPeserta;
  //     $peserta->training_id = $training->id;
  //     $peserta->karyawan_id = $val;
  //     $peserta->save();
  //   }

  //   foreach ($request->pengisi as $key => $val) {
  //     $pengisi = new TrainingPengisi;
  //     $pengisi->training_id = $training->id;
  //     $pengisi->karyawan_id = $val;
  //     $pengisi->save();
  //   }

  //   foreach ($request->modul as $key => $val) {
  //     $modul = new TrainingModul;
  //     $modul->training_id = $training->id;
  //     $modul->modul_id = $val;
  //     $modul->save();
  //   }
    
  //   return redirect()->route('training')->with('message', 'Data berhasil ditambahkan.');
  // }

  // public function trainingShow($id)
  // {
  //   $training = Training::find($id);
  //   $training_peserta = TrainingPeserta::where('training_id', $training->id)->get();
  //   $training_pengisi = TrainingPengisi::where('training_id', $training->id)->get();
  //   $training_modul = TrainingModul::where('training_id', $training->id)->get();
  //   $divisi = MasterDivisi::get();
  //   $karyawan = MasterKaryawan::where('status', 'Aktif')->get();
  //   $modul = Modul::get();
    
  //   return view('pages.training.show', [
  //     'training' => $training,
  //     'divisis' => $divisi,
  //     'karyawans' => $karyawan,
  //     'moduls' => $modul,
  //     'training_pesertas' => $training_peserta,
  //     'training_pengisis' => $training_pengisi,
  //     'training_moduls' => $training_modul
  //   ]);
  // }

  // public function trainingEdit($id)
  // {
  //   $training = Training::find($id);
  //   $training_peserta = TrainingPeserta::where('training_id', $training->id)->get();
  //   $training_pengisi = TrainingPengisi::where('training_id', $training->id)->get();
  //   $training_modul = TrainingModul::where('training_id', $training->id)->get();
  //   $divisi = MasterDivisi::get();
  //   $karyawan = MasterKaryawan::where('status', 'Aktif')->get();
  //   $modul = Modul::get();

  //   return view('pages.training.edit', [
  //     'training' => $training,
  //     'divisis' => $divisi,
  //     'karyawans' => $karyawan,
  //     'moduls' => $modul,
  //     'training_pesertas' => $training_peserta,
  //     'training_pengisis' => $training_pengisi,
  //     'training_moduls' => $training_modul
  //   ]);
  // }

  // public function trainingUpdate(Request $request, $id)
  // {
  //   $training = Training::find($id);
  //   $training->kategori = $request->kategori;
  //   $training->judul = $request->judul;
  //   $training->divisi_id = $request->divisi_id;
  //   $training->tanggal = $request->tanggal;
  //   $training->durasi = $request->durasi;
  //   $training->tempat = $request->tempat;
  //   $training->goal = $request->goal;
  //   $training->jenis = $request->jenis;
  //   $training->hasil = $request->hasil;
  //   $training->save();

  //   $training_peserta = TrainingPeserta::where('training_id', $training->id);
  //   if ($training_peserta) {
  //     $training_peserta->delete();
  //   }
  //   $training_pengisi = TrainingPengisi::where('training_id', $training->id);
  //   if ($training_pengisi) {
  //     $training_pengisi->delete();
  //   }
  //   $training_modul = TrainingModul::where('training_id', $training->id);
  //   if ($training_modul) {
  //     $training_modul->delete();
  //   }

  //   foreach ($request->peserta as $key => $val) {
  //     $peserta = new TrainingPeserta;
  //     $peserta->training_id = $training->id;
  //     $peserta->karyawan_id = $val;
  //     $peserta->save();
  //   }

  //   foreach ($request->pengisi as $key => $val) {
  //     $pengisi = new TrainingPengisi;
  //     $pengisi->training_id = $training->id;
  //     $pengisi->karyawan_id = $val;
  //     $pengisi->save();
  //   }

  //   foreach ($request->modul as $key => $val) {
  //     $modul = new TrainingModul;
  //     $modul->training_id = $training->id;
  //     $modul->modul_id = $val;
  //     $modul->save();
  //   }
    
  //   return redirect()->route('training')->with('message', 'Data berhasil diperbaharui.');
  // }

  // public function trainingDelete($id)
  // {
  //   $training = Training::find($id);

  //   $training_peserta = TrainingPeserta::where('training_id', $training->id);
  //   if ($training_peserta) {
  //     $training_peserta->delete();
  //   }
  //   $training_pengisi = TrainingPengisi::where('training_id', $training->id);
  //   if ($training_pengisi) {
  //     $training_pengisi->delete();
  //   }
  //   $training_modul = TrainingModul::where('training_id', $training->id);
  //   if ($training_modul) {
  //     $training_modul->delete();
  //   }

  //   $training->delete();

  //   return redirect()->route('training')->with('message', 'Data berhasil dihapus.');
  // }

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
}