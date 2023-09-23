<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\Persetujuan;
use App\Models\PersetujuanApprover;
use App\Models\PersetujuanPengajuanApprover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PersetujuanController extends Controller
{
  public function index()
  {
    if (Auth::user()->master_karyawan_id == 0) {
      $persetujuan = Persetujuan::orderBy('id', 'desc')->limit(100)->get();
    } else {
      $persetujuan_approvers = PersetujuanPengajuanApprover::where('atasan', 'like', '%'.Auth::user()->master_karyawan_id.'%')
        ->get();
      if (count($persetujuan_approvers) > 0) {
        $persetujuan = Persetujuan::with('karyawan')
          ->orderBy('id', 'desc')
          ->limit(100)
          ->get();
      } else {
        $persetujuan = Persetujuan::where('karyawan_id', Auth::user()->master_karyawan_id)
          ->orWhere('disposisi_id', Auth::user()->masterKaryawan->master_jabatan_id)
          ->orderBy('id', 'desc')
          ->limit(100)
          ->get();
      }
    }

    $karyawan = MasterKaryawan::get();
    $jabatan = MasterJabatan::get();

    return view('pages.persetujuan.index', [
      'persetujuans' => $persetujuan,
      'karyawans' => $karyawan,
      'jabatans' => $jabatan
    ]);
  }

  public function create()
  {
    $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);
    if ($karyawan) {
      $pemohon = $karyawan->masterJabatan->nama_jabatan;
    } else {
      $pemohon = "admin";
    }
    
    return view('pages.persetujuan.create', ['pemohon' => $pemohon]);
  }

  public function store(Request $request)
  {
    $persetujuan = new Persetujuan;
    $persetujuan->karyawan_id = Auth::user()->master_karyawan_id;
    $persetujuan->judul = $request->judul;
    $persetujuan->pemohon = $request->pemohon;
    $persetujuan->sifat = $request->sifat;
    $persetujuan->keterangan = $request->keterangan;

    if($request->hasFile('lampiran')) {
      $file = $request->file('lampiran');
      $extension = $file->getClientOriginalExtension();
      $filename = time() . "." . $extension;
      $file->move(env('APP_URL_IMG') . 'img_persetujuan/', $filename);
      $persetujuan->lampiran = $filename;
    }

    $persetujuan->save();    

    $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

    if ($karyawan) {
      $role = MasterRole::where('nama', $karyawan->role)->first();
      $approve = PersetujuanApprover::where('role_id', $role->id)->get();
      foreach ($approve as $key => $value) {
        $cuti_detail = new PersetujuanPengajuanApprover;
        $cuti_detail->pengajuan_id = $persetujuan->id;
        $cuti_detail->hirarki = $value->hirarki;
        $cuti_detail->atasan = $value->atasan_id;
        $cuti_detail->status = 0;
        $cuti_detail->confirm = 0;
        $cuti_detail->approved_text = "Request";
        $cuti_detail->approved_percentage = "0";
        $cuti_detail->approved_background = "secondary";
        $cuti_detail->save();
      }
    }

    return redirect()->route('persetujuan');
  }

  public function show($id)
  {
    $persetujuan = Persetujuan::find($id);

    return view('pages.persetujuan.show', ['persetujuan' => $persetujuan]);
  }

  public function delete($id)
  {
    $persetujuan = Persetujuan::find($id);

    if (file_exists(env('APP_URL_IMG') . "img_persetujuan/" . $persetujuan->lampiran)) {
      File::delete(env('APP_URL_IMG') . "img_persetujuan/" . $persetujuan->lampiran);
    }

    $persetujuan->delete();

    return redirect()->route('persetujuan');
  }

  // approver
  public function approver()
  {
    return view('pages.persetujuan.approver');
  }
  public function approverData()
  {
    $approver = PersetujuanApprover::with('role')
      ->select(DB::raw('count(hirarki) as hirarki, role_id'))
      ->groupBy('role_id')
      ->orderBy('role_id', 'desc')
      ->get();

    $approver_all = PersetujuanApprover::get();

    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

    return response()->json([
      'approvers' => $approver,
      'approve_alls' => $approver_all,
      'karyawans' => $karyawan
      // 'data' => 'a'
    ]);
  }
  public function approverCreate()
  {
    $role = MasterRole::doesntHave('approvePersetujuan')->orderBy('hirarki', 'asc')->get();

    return response()->json([
      'roles' => $role
    ]);
  }
  public function approverStore(Request $request)
  {
    $approve = new PersetujuanApprover;
    $approve->role_id = $request->role_id;
    $approve->hirarki = 1;
    $approve->atasan_id = json_encode([""]);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverUpdate(Request $request)
  {
    $approve = PersetujuanApprover::find($request->id);

    $atasan_array = [];
    foreach ($request->atasan_id as $key => $value) {
        $data = explode("_", $value);
        $atasan_array[] = $data[0];
    }

    $approve->atasan_id = json_encode($atasan_array);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverAdd(Request $request)
  {
    $getApprove = PersetujuanApprover::where('role_id', $request->role_id)->get();
    $count_hirarki = count($getApprove);

    $approve = new PersetujuanApprover;
    $approve->role_id = $request->role_id;
    $approve->hirarki = $count_hirarki + 1;
    $approve->atasan_id = json_encode([""]);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverDeleteAllBtn($id)
  {
    return response()->json([
      'id' => $id
    ]);
  }
  public function approverDeleteAll(Request $request)
  {
    $approve = PersetujuanApprover::where('role_id', $request->id);
    $approve->delete();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverDeleteBtn($id)
  {
    return response()->json([
      'id' => $id
    ]);
  }
  public function approverDelete(Request $request)
  {
    $approve = PersetujuanApprover::find($request->id);
    $approve->delete();

    return response()->json([
      'status' => 200
    ]);
  }

  // approved
  public function approved(Request $request)
  {
    $abdul_pengajuan_approver = PersetujuanPengajuanApprover::find($request->id);

    // update status, agar cuti tampil di approver selanjutnya
    $hirarki = $abdul_pengajuan_approver->hirarki + 1;

    $total_pengajuan_approver = count(PersetujuanPengajuanApprover::where('pengajuan_id', $abdul_pengajuan_approver->pengajuan_id)->get());

    if ($hirarki <= $total_pengajuan_approver) {
      $abdul_pengajuan_approver_next = PersetujuanPengajuanApprover::where('pengajuan_id', $abdul_pengajuan_approver->pengajuan_id)->where('hirarki', $hirarki)->first();
      $abdul_pengajuan_approver_next->status = 1;
      $abdul_pengajuan_approver_next->save();
    }
    // end

    // hitung persentase progress
    $percentage = ceil(100 / $total_pengajuan_approver);
    // end

    $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
    if ($karyawan->jenis_kelamin == "L") {
      $approved_text = "Approved Oleh Pak";
    } else {
      $approved_text = "Approved Oleh Bu";
    }

    $abdul_pengajuan_approver->status = 1;
    $abdul_pengajuan_approver->confirm = 1;
    $abdul_pengajuan_approver->approved_date = date('Y-m-d H:i:s');
    $abdul_pengajuan_approver->approved_leader = Auth::user()->master_karyawan_id;
    $abdul_pengajuan_approver->approved_text = $approved_text;
    $abdul_pengajuan_approver->approved_percentage = $abdul_pengajuan_approver->approved_percentage + $percentage;
    $abdul_pengajuan_approver->approved_background = "primary";
    $abdul_pengajuan_approver->approved_keterangan = $request->keterangan;
    $abdul_pengajuan_approver->save();

    

    $pengajuan = Persetujuan::find($abdul_pengajuan_approver->pengajuan_id);

    if ($request->disposisi) {
      $jabatan = MasterJabatan::find($request->disposisi);
      $pengajuan->disposisi = $jabatan->nama_jabatan;
      $pengajuan->disposisi_id = $jabatan->id;
    }
    
    $pengajuan->approved_date = date('Y-m-d H:i:s');
    $pengajuan->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan->approved_text = $approved_text;
    $pengajuan->approved_percentage = $pengajuan->approved_percentage + $percentage;
    $pengajuan->approved_background = "primary";
    $pengajuan->save();

    $percentage_result = $pengajuan->approved_percentage + $percentage;

    return response()->json([
      'status' => 'true'
    ]);
  }
  public function disapproved(Request $request)
  {
    $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
    if ($karyawan->jenis_kelamin == "L") {
      $approved_text = "Disapproved Oleh Pak";
    } else {
      $approved_text = "Disapproved Oleh Bu";
    }

    $pengajuan_approver = PersetujuanPengajuanApprover::find($request->id);
    $pengajuan_approver->status = 1;
    $pengajuan_approver->confirm = 2;
    $pengajuan_approver->approved_date = date('Y-m-d H:i:s');
    $pengajuan_approver->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan_approver->approved_text = $approved_text;
    $pengajuan_approver->approved_percentage = 100;
    $pengajuan_approver->approved_background = "danger";
    $pengajuan_approver->approved_keterangan = $request->keterangan;
    $pengajuan_approver->save();

    $pengajuan = Persetujuan::find($pengajuan_approver->pengajuan_id);
    $pengajuan->approved_date = date('Y-m-d H:i:s');
    $pengajuan->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan->approved_text = $approved_text;
    $pengajuan->approved_percentage = 100;
    $pengajuan->approved_background = "danger";
    $pengajuan->save();

    return response()->json([
      'status' => 'true'
    ]);
  }
}
