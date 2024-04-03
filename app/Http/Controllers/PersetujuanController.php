<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\Persetujuan;
use App\Models\PersetujuanDetail;
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
      $persetujuan_detail = PersetujuanDetail::where('atasan_id', Auth::user()->master_karyawan_id)
        ->get();
      if (count($persetujuan_detail) > 0) {
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
    $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

    if ($karyawan) {
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

      $role = MasterRole::where('nama', $karyawan->role)->first();
      $approver = Approver::where('jenis', 'direktur')->where('role_id', $role->id)->first();

      foreach ($approver->dataDetail as $key => $value) {
        $persetujuan_detail = new PersetujuanDetail;
        $persetujuan_detail->hirarki = $value->hirarki;
        $persetujuan_detail->approver_id = $approver->id;
        $persetujuan_detail->jenis = $approver->jenis;
        $persetujuan_detail->role = $role->nama;
        $persetujuan_detail->persetujuan_id = $persetujuan->id;
        $persetujuan_detail->atasan_id = $value->karyawan_id;
        $persetujuan_detail->atasan_nama = $value->dataKaryawan->nama_panggilan;
        $persetujuan_detail->save();
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

    $persetujuan_detail = PersetujuanDetail::where('persetujuan_id', $persetujuan->id);
    if ($persetujuan_detail) {
      $persetujuan_detail->delete();
    }

    $persetujuan->delete();

    return redirect()->route('persetujuan');
  }

  // approver
  // public function approver()
  // {
  //   return view('pages.persetujuan.approver');
  // }
  // public function approverData()
  // {
  //   $approver = PersetujuanApprover::with('role')
  //     ->select(DB::raw('count(hirarki) as hirarki, role_id'))
  //     ->groupBy('role_id')
  //     ->orderBy('role_id', 'desc')
  //     ->get();

  //   $approver_all = PersetujuanApprover::get();

  //   $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

  //   return response()->json([
  //     'approvers' => $approver,
  //     'approve_alls' => $approver_all,
  //     'karyawans' => $karyawan
  //     // 'data' => 'a'
  //   ]);
  // }
  // public function approverCreate()
  // {
  //   $role = MasterRole::doesntHave('approvePersetujuan')->orderBy('hirarki', 'asc')->get();

  //   return response()->json([
  //     'roles' => $role
  //   ]);
  // }
  // public function approverStore(Request $request)
  // {
  //   $approve = new PersetujuanApprover;
  //   $approve->role_id = $request->role_id;
  //   $approve->hirarki = 1;
  //   $approve->atasan_id = json_encode([""]);
  //   $approve->save();

  //   return response()->json([
  //     'status' => 200
  //   ]);
  // }
  // public function approverUpdate(Request $request)
  // {
  //   $approve = PersetujuanApprover::find($request->id);

  //   $atasan_array = [];
  //   foreach ($request->atasan_id as $key => $value) {
  //       $data = explode("_", $value);
  //       $atasan_array[] = $data[0];
  //   }

  //   $approve->atasan_id = json_encode($atasan_array);
  //   $approve->save();

  //   return response()->json([
  //     'status' => 200
  //   ]);
  // }
  // public function approverAdd(Request $request)
  // {
  //   $getApprove = PersetujuanApprover::where('role_id', $request->role_id)->get();
  //   $count_hirarki = count($getApprove);

  //   $approve = new PersetujuanApprover;
  //   $approve->role_id = $request->role_id;
  //   $approve->hirarki = $count_hirarki + 1;
  //   $approve->atasan_id = json_encode([""]);
  //   $approve->save();

  //   return response()->json([
  //     'status' => 200
  //   ]);
  // }
  // public function approverDeleteAllBtn($id)
  // {
  //   return response()->json([
  //     'id' => $id
  //   ]);
  // }
  // public function approverDeleteAll(Request $request)
  // {
  //   $approve = PersetujuanApprover::where('role_id', $request->id);
  //   $approve->delete();

  //   return response()->json([
  //     'status' => 200
  //   ]);
  // }
  // public function approverDeleteBtn($id)
  // {
  //   return response()->json([
  //     'id' => $id
  //   ]);
  // }
  // public function approverDelete(Request $request)
  // {
  //   $approve = PersetujuanApprover::find($request->id);
  //   $approve->delete();

  //   return response()->json([
  //     'status' => 200
  //   ]);
  // }

  // approved
  public function approved(Request $request)
  {
    $persetujuan_detail = PersetujuanDetail::where('persetujuan_id', $request->status)->where('hirarki', $request->hirarki)
      ->update([
        'status' => 1,
        'approved_keterangan' => $request->keterangan,
        'approved_date' => date('Y-m-d H:i:s')
      ]);

    $persetujuan_detail_confirm = PersetujuanDetail::where('persetujuan_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    $persetujuan = Persetujuan::find($request->status);
    if ($request->disposisi) {
      $jabatan = MasterJabatan::find($request->disposisi);
      $persetujuan->disposisi = $jabatan->nama_jabatan;
      $persetujuan->disposisi_id = $jabatan->id;
    }
    $persetujuan->save();

    return response()->json([
      'status' => 'true'
    ]);
  }

  public function disapproved(Request $request)
  {
    $persetujuan_detail = PersetujuanDetail::where('persetujuan_id', $request->status)->where('hirarki', $request->hirarki)
    ->update([
      'status' => 0,
      'approved_keterangan' => $request->keterangan,
      'approved_date' => date('Y-m-d H:i:s')
    ]);

    $persetujuan_detail_confirm = PersetujuanDetail::where('persetujuan_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    return response()->json([
      'status' => 'true'
    ]);
  }

  public function detailApprover(Request $request)
  {
    $persetujuan_detail = PersetujuanDetail::with('dataAtasan')->where('persetujuan_id', $request->id)->where('hirarki', $request->hirarki)->get();

    return response()->json([
      'persetujuan_detail' => $persetujuan_detail
    ]);
  }
}
