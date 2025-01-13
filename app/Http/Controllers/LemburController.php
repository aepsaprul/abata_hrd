<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use App\Models\LemburDetail;
use App\Models\LemburTask;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LemburController extends Controller
{
  public function index()
  {
    $lemburs = Lembur::orderBy('id', 'desc')->get();

    return view('pages.lembur.index', compact('lemburs'));
  }

  public function create()
  {
    $karyawan_id = Auth::user()->master_karyawan_id;
    if ($karyawan_id == 0) {
      $karyawan = MasterKaryawan::find(45);
    } else {
      $karyawan = MasterKaryawan::find($karyawan_id);
    }
    $cabang_id = $karyawan->master_cabang_id;
    $karyawans = MasterKaryawan::where('master_cabang_id', $cabang_id)->where('status', 'Aktif')->get();
    $tasks = LemburTask::get();

    return view('pages.lembur.create', compact('karyawans', 'tasks'));
  }

  public function createForm()
  {
    $karyawan_id = Auth::user()->master_karyawan_id;
    if ($karyawan_id == 0) {
      $karyawan = MasterKaryawan::find(45);
    } else {
      $karyawan = MasterKaryawan::find($karyawan_id);
    }
    $cabang_id = $karyawan->master_cabang_id;
    $karyawans = MasterKaryawan::where('master_cabang_id', $cabang_id)->where('status', 'Aktif')->get();
    $tasks = LemburTask::get();

    return response()->json([
      'karyawans' => $karyawans,
      'tasks' => $tasks
    ]);
  }

  public function store(Request $request)
  {
    $input_karyawan = $request->karyawan;
    $mulai = $request->mulai;
    $selesai = $request->selesai;
    $task = $request->task;
    $keterangan = $request->keterangan;

    $user = Auth::user();
    if ($user->master_karyawan_id == 0) {
      $karyawan = MasterKaryawan::find(45);
    } else {
      $karyawan = MasterKaryawan::find($user->master_karyawan_id);
    }

    $jabatan = MasterJabatan::find($karyawan->master_jabatan_id);
    $cabang = MasterCabang::find($karyawan->master_cabang_id);

    $lembur = new Lembur;
    $lembur->user_id = $user->id;
    $lembur->nama_karyawan = $karyawan->nama_lengkap;
    $lembur->jabatan = $jabatan->nama_jabatan;
    $lembur->cabang = $cabang->nama_cabang;
    $lembur->save();

    for ($i=0; $i < count($input_karyawan); $i++) { 
      $lembur_karyawan = MasterKaryawan::find($input_karyawan[$i]);
      $lembur_jabatan = MasterJabatan::find($lembur_karyawan->master_jabatan_id);
      $lembur_task = LemburTask::find($task[$i]);

      $lembur_detail = new LemburDetail;
      $lembur_detail->lembur_id = $lembur->id;
      $lembur_detail->karyawan_id = $input_karyawan[$i];
      $lembur_detail->nama_karyawan = $lembur_karyawan->nama_lengkap;
      $lembur_detail->jabatan = $lembur_jabatan->nama_jabatan;
      $lembur_detail->mulai = $mulai[$i];
      $lembur_detail->selesai = $selesai[$i];
      $lembur_detail->task_id = $task[$i];
      if ($lembur_task) {
        $lembur_detail->nama_task = $lembur_task->nama;
      }
      $lembur_detail->keterangan = $keterangan[$i];
      $lembur_detail->save();
    }

    return redirect()->route('lembur')->with('message', 'Data berhasil di tambahkan');
  }

  public function show($id)
  {
    $lembur = Lembur::with('dataDetail')->find($id);

    return view('pages.lembur.show', compact('lembur'));
  }

  public function edit($id)
  {
    $lembur = Lembur::with('dataDetail')->find($id);

    return view('pages.lembur.edit', compact('lembur'));
  }

  public function update(Request $request, $id)
  {
    $lembur_detail = LemburDetail::find($id);
    $lembur_detail->mulai = $request->mulai;
    $lembur_detail->selesai = $request->selesai;
    $lembur_detail->save();
    
    return response()->json([
      'message' => 'success'
    ]);
  }

  public function delete($id)
  {
    $lembur = Lembur::find($id);

    $lembur_detail = LemburDetail::where('lembur_id', $lembur->id);
    $lembur_detail->delete();

    $lembur->delete();

    return redirect()->route('lembur')->with('message', 'Data berhasil dihapus');
  }

  public function task()
  {
    $tasks = LemburTask::orderBy('id', 'desc')->get();

    return view('pages.lembur.task', compact('tasks'));
  }

  public function taskCreate()
  {
    return view('pages.lembur.taskCreate');
  }

  public function taskStore(Request $request)
  {
    $task = new LemburTask;
    $task->nama = $request->nama;
    $task->save();

    return redirect()->route('lembur.task')->with('message', 'Data berhasil di tambah');
  }

  public function taskEdit($id)
  {
    $task = LemburTask::find($id);

    return view('pages.lembur.taskEdit', compact('task'));
  }

  public function taskUpdate(Request $request, $id)
  {
    $task = LemburTask::find($id);
    $task->nama = $request->nama;
    $task->save();

    return redirect()->route('lembur.task')->with('message', 'Data berhasil di perbaharui');
  }

  public function taskDelete($id)
  {
    $task = LemburTask::find($id);
    $task->delete();

    return redirect()->route('lembur.task')->with('message', 'Data berhasil di hapus');
  }
}
