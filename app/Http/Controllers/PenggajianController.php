<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\HcPenggajian;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\PenggajianApprover;
use App\Models\PenggajianDetail;
use App\Models\User;
use App\Notifications\PenggajianNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PenggajianController extends Controller
{
  public function index()
  {
    $karyawan_id = Auth::user()->master_karyawan_id;
    $penggajian = HcPenggajian::with(['masterKaryawan', 'penggajianDetail'])
      ->orderBy('id', 'desc')
      ->get();

    $penggajian_detail = PenggajianDetail::with('penggajian')->where('atasan', $karyawan_id)->orderBy('id', 'desc')->get();

    return view('pages.penggajian.index', [
      'penggajians' => $penggajian,
      'penggajian_details' => $penggajian_detail
    ]);
  }

  public function store(Request $request)
  {
    if ($request->status == "baru") {
      $status = "Gaji Payroll Bulan " . $request->bulan . " " . $request->tahun;
    } else {
      $status = "Revisi Payroll Bulan " . $request->bulan . " " . $request->tahun;
    }
    $penggajian = new HcPenggajian;
    $penggajian->karyawan_id = Auth::user()->masterKaryawan->id;
    $penggajian->judul = $status;
    $penggajian->tanggal_upload = date('Y-m-d H:i:s');
    $penggajian->status = 1;
    $penggajian->status_bar = "50%";

    if($request->hasFile('create_file')) {
      $file = $request->file('create_file');
      $extension = $file->getClientOriginalExtension();
      $filename = $file->getClientOriginalName();
      $file->move(env('APP_URL_IMG') . 'file/pengajuan/', $filename);
      $penggajian->file = $filename;
    }

    $penggajian->approved_text = "Permohonan Penggajian";
    $penggajian->approved_percentage = "0";
    $penggajian->approved_background = "secondary";
    $penggajian->save();

    $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);
    $role = MasterRole::where('nama', $karyawan->role)->first();
    $approver = Approver::where('jenis', 'penggajian')->where('role_id', $role->id)->first();

    foreach ($approver->dataDetail as $key => $value) {
      $penggajian_detail = new PenggajianDetail;
      $penggajian_detail->approver_id = $approver->id;
      $penggajian_detail->jenis = $approver->jenis;
      $penggajian_detail->role = $role->nama;
      $penggajian_detail->penggajian_id = $penggajian->id;
      $penggajian_detail->hirarki = $value->hirarki;
      $penggajian_detail->atasan_id = $value->karyawan_id;
      $penggajian_detail->atasan_nama = $value->dataKaryawan->nama_panggilan;
      $penggajian_detail->save();
    }

    return response()->json([
      'status' => 200,
      'message' => "Data berhasil ditambahkan"
    ]);
  }

  public function deleteBtn($id)
  {
    $penggajian = HcPenggajian::find($id);

    return response()->json([
      'id' => $penggajian->id
    ]);
  }

  public function delete(Request $request)
  {
    $penggajian = HcPenggajian::find($request->id);
    $penggajian->delete();

    $penggajian_detail = PenggajianDetail::where('penggajian_id', $request->id);
    $penggajian_detail->delete();

    if (file_exists(env('APP_URL_IMG') . "file/pengajuan/" . $penggajian->file)) {
      File::delete(env('APP_URL_IMG') . "file/pengajuan/" . $penggajian->file);
    }

    return response()->json([
      'status' => 'Data berhasil dihapus'
    ]);
  }

  public function approved(Request $request)
  {
    $penggajian_detail = PenggajianDetail::where('penggajian_id', $request->status)->where('hirarki', $request->hirarki)
      ->update([
        'status' => 1,
        'approved_keterangan' => $request->keterangan,
        'approved_date' => date('Y-m-d H:i:s')
      ]);

    $penggajian_detail_confirm = PenggajianDetail::where('penggajian_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    return response()->json([
      'status' => 200,
      'message' => 'sukses'
    ]);
  }

  public function disapproved(Request $request)
  {
    $penggajian_detail = PenggajianDetail::where('penggajian_id', $request->status)->where('hirarki', $request->hirarki)
    ->update([
      'status' => 0,
      'approved_keterangan' => $request->keterangan,
      'approved_date' => date('Y-m-d H:i:s')
    ]);

    $penggajian_detail_confirm = PenggajianDetail::where('penggajian_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    return response()->json([
      'status' => 200,
      'message' => 'sukses'
    ]);
  }
}
