<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\Lembur;
use App\Models\LemburApprover;
use App\Models\LemburDetail;
use App\Models\LemburTask;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LemburController extends Controller
{
  public function index()
  {
    if (Auth::user()->master_karyawan_id == 0) {
      $lemburs = Lembur::orderBy('id', 'desc')->limit(500)->get();
    } else {
      $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

      // Retrieve lemburs made by the current user or where the user is an approver
      $lemburs = Lembur::where('user_id', Auth::user()->id)
        ->orWhereHas('dataApprover', function ($query) use ($karyawan) {
          $query->where('atasan_id', $karyawan->id);
        })
        ->with('dataApprover')
        ->orderBy('id', 'desc')
        ->limit(500)
        ->get();
    }
    
    $cabangs = MasterCabang::orderBy('grup', 'desc')->get();

    return view('pages.lembur.index', compact(['lemburs', 'cabangs']));
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
    $lembur->karyawan_id = $karyawan->id;
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

    // approver
    $role = MasterRole::where('nama', $karyawan->role)->first();
    $approver = Approver::where('jenis', 'lembur')->where('role_id', $role->id)->first();

    foreach ($approver->dataDetail as $key => $value) {
      $lembur_approver = new LemburApprover;
      $lembur_approver->lembur_id = $lembur->id;
      $lembur_approver->hierarki = $value->hirarki;
      $lembur_approver->approver_id = $approver->id;
      $lembur_approver->jenis = $approver->jenis;
      $lembur_approver->role = $role->nama;
      $lembur_approver->atasan_id = $value->karyawan_id;
      $lembur_approver->atasan_nama = $value->dataKaryawan->nama_panggilan;
      $lembur_approver->save();
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

    $lembur_approver = LemburApprover::where('lembur_id', $lembur->id);
    $lembur_approver->delete();

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

  // approved
  public function approved(Request $request)
  {
    $lembur_approver = LemburApprover::where('lembur_id', $request->status)->where('hierarki', $request->hirarki)
      ->update([
        'status' => 1,
        'approved_keterangan' => $request->keterangan,
        'approved_date' => date('Y-m-d H:i:s')
      ]);

    $lembur_approver_confirm = LemburApprover::where('lembur_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

      $hirarkiDb = LemburApprover::where('lembur_id', $request->status)
      ->groupBy('hierarki')
      ->get();
    $hirarki = count($hirarkiDb);

    $confirmDb = LemburApprover::where('lembur_id', $request->status)
      ->where('confirm', 1)
      ->get();
    $confirm = count($confirmDb);

    if ($confirm >= $hirarki) {
      $lembur = Lembur::find($request->status);
      $lembur->status_approve = 'complete';
      $lembur->save();
    } else {
      $lembur = Lembur::find($request->status);
      $lembur->status_approve = 'pending';
      $lembur->save();
    }

    return response()->json([
      'status' => 200,
      'message' => 'sukses',
      'data' => $confirm,
      'hirarki' => $hirarki
    ]);
  }

  public function disapproved(Request $request)
  {
    $lembur_approver = LemburApprover::where('lembur_id', $request->status)->where('hierarki', $request->hirarki)
    ->update([
      'status' => 0,
      'approved_keterangan' => $request->keterangan,
      'approved_date' => date('Y-m-d H:i:s')
    ]);

    $lembur_approver_confirm = LemburApprover::where('lembur_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    $hirarki = LemburApprover::where('lembur_id', $request->status)
      ->groupBy('hierarki')
      ->count();

    $confirm = LemburApprover::where('lembur_id', $request->status)
      ->where('confirm', 1)
      ->count();

    if ($confirm >= $hirarki) {
      $lembur = Lembur::find($request->status);
      $lembur->status_approve = 'complete';
      $lembur->save();
    } else {
      $lembur = Lembur::find($request->status);
      $lembur->status_approve = 'pending';
      $lembur->save();
    }

    return response()->json([
      'status' => 200,
      'message' => 'sukses'
    ]);
  }

  public function detailApprover(Request $request)
  {
    $lembur_approver = LemburApprover::with('dataAtasan')->where('lembur_id', $request->id)->where('hierarki', $request->hirarki)->get();

    return response()->json([
      'lembur_approver' => $lembur_approver
    ]);
  }

  public function filter(Request $request)
  {
    $startDate = $request->start_date . " 00:00:00";
    $endDate = $request->end_date . " 23:59:00";
    $cabang = $request->input('filter_cabang', []);

    $query = Lembur::query();

    if (!empty($startDate)) {
      $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    if (!empty($cabang)) {
      $query->whereHas('dataKaryawan', function ($q) use ($cabang) {
        $q->whereIn('master_cabang_id', $cabang);
      });
    }

    return response()->json([
      'lemburs' => $query->get(),
      'cabang' => $cabang
    ]);
  }
}
