<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Events\EventPengajuan;
use App\Models\CutiApprover;
use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
  public function index()
  {
    if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
      $cuti = HcCuti::orderBy('id', 'desc')->limit(30)->get();
    } else {
      $cuti_detail = CutiDetail::where('atasan_id', Auth::user()->master_karyawan_id)->get();
      if (count($cuti_detail) > 0) {
        $cuti = HcCuti::with('masterKaryawan')
          ->whereHas('masterKaryawan', function ($query) {
            $query->where('master_cabang_id', Auth::user()->masterKaryawan->master_cabang_id);
          })
          ->orderBy('id', 'desc')
          ->limit(30)
          ->get();
      } else {
        $cuti = HcCuti::where('master_karyawan_id', Auth::user()->master_karyawan_id)
          ->orderBy('id', 'desc')
          ->limit(30)
          ->get();
      }
    }

    $karyawan = MasterKaryawan::get();

    return view('pages.cuti.index', [
      'cutis' => $cuti,
      'karyawans' => $karyawan
    ]);
  }

  public function show($id)
  {
    $cuti = HcCuti::with('masterKaryawan', 'karyawanPengganti', 'cutiTgl')->find($id);

    return response()->json([
      'cuti' => $cuti
    ]);
  }

  public function deleteBtn($id)
  {
    $cuti = HcCuti::find($id);

    return response()->json([
      'id' => $cuti->id
    ]);
  }

  public function delete(Request $request)
  {
    $cuti = HcCuti::find($request->id);

    $cuti_detail = CutiDetail::where('cuti_id', $cuti->id);
    $cuti_detail->delete();

    $cuti_tgl = HcCutiTgl::where('hc_cuti_id', $cuti->id);
    $cuti_tgl->delete();

    $cuti->delete();

    // activity_log($cuti, "cuti", "deleted");

    return response()->json([
      'status' => 'true'
    ]);
  }

  // cuti
  public function create()
  {
    if (Auth::user()->master_karyawan_id == 0) {
      $karyawan = MasterKaryawan::with('masterJabatan')->where('id', 45)->first();
    } else {
      $karyawan = MasterKaryawan::with('masterJabatan')->where('id', Auth::user()->master_karyawan_id)->first();
    }

    $atasans = MasterKaryawan::where('id', '!=', Auth::user()->master_karyawan_id)->get();
    $pengganti = MasterKaryawan::where('id', '!=', Auth::user()->master_karyawan_id)->get();

    return response()->json([
      'karyawan' => $karyawan,
      'atasans' => $atasans,
      'pengganti' => $pengganti
    ]);
  }

  public function store(Request $request)
  {
    $messages = [
      'nama.required' => 'Nama harus diisi',
      'karyawan_id.required' => 'karyawan id harus diisi',
      'telepon.required' => 'Telepon harus diisi',
      'telepon.max' => 'Telepon diisi maksimal 15 karakter',
      'jenis.required' => 'Jenis harus diisi',
      'jml_hari.required' => 'Jumlah hari harus diisi',
      'pengganti.required' => 'Pengganti harus diisi',
      'alasan.required' => 'Alasan harus diisi'
    ];

    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'karyawan_id' => 'required',
      'telepon' => 'required|max:15',
      'jenis' => 'required',
      'jml_hari' => 'required',
      'pengganti' => 'required',
      'alasan' => 'required'
    ], $messages);

    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'errors' => $validator->errors()
      ]);
    } else {
      if ($request->jml_hari > $request->sisa_cuti) {
        return response()->json([
          'status' => 400,
          'errors' => $validator->errors(),
          'error_sisa_cuti' => 'Jumlah hari tidak boleh melebihi dari sisa cuti'
        ]);
      } else {
        if ($request->jenis == "lainnya") {
          $jenis = "lainnya : " . $request->form_cuti_lainnya;
        } else {
          $jenis = $request->jenis;
        }

        $cuti = new HcCuti;
        $cuti->master_karyawan_id = $request->karyawan_id;
        $cuti->master_jabatan_id = $request->jabatan_id;
        $cuti->atasan = $request->atasan;
        $cuti->telepon = $request->telepon;
        $cuti->alamat = $request->alamat;
        $cuti->jenis = $jenis;
        $cuti->jml_hari = $request->jml_hari;
        $cuti->karyawan_pengganti = $request->pengganti;
        $cuti->alasan = $request->alasan;
        $cuti->tanggal = date("Y-m-d");
        $cuti->status = 1;
        $cuti->save();

        foreach ($request->cuti_tanggal as $key => $value) {
          $cuti_tgl = new HcCutiTgl;
          $cuti_tgl->hc_cuti_id = $cuti->id;
          $cuti_tgl->tanggal = $value;
          $cuti_tgl->save();
        }

        $karyawan = MasterKaryawan::find($request->karyawan_id);
        $role = MasterRole::where('nama', $karyawan->role)->first();
        $approver = Approver::where('jenis', 'cuti')->where('role_id', $role->id)->first();

        foreach ($approver->dataDetail as $key => $value) {
          $cuti_detail = new CutiDetail;
          $cuti_detail->hirarki = $value->hirarki;
          $cuti_detail->approver_id = $approver->id;
          $cuti_detail->jenis = $approver->jenis;
          $cuti_detail->role = $role->nama;
          $cuti_detail->cuti_id = $cuti->id;
          $cuti_detail->atasan_id = $value->karyawan_id;
          $cuti_detail->atasan_nama = $value->dataKaryawan->nama_panggilan;
          $cuti_detail->save();
        }

        return response()->json([
          'status' => 200,
          'message' => "Data berhasil ditambahkan"
        ]);
      }
    }
  }

  public function approved(Request $request)
  {
    $cuti_detail = CutiDetail::where('cuti_id', $request->status)->where('hirarki', $request->hirarki)
      ->update([
        'status' => 1,
        'approved_keterangan' => $request->keterangan
      ]);

    $cuti_detail_confirm = CutiDetail::where('cuti_id', $request->status)->where('atasan_id', $request->confirm)
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
    $cuti_detail = CutiDetail::where('cuti_id', $request->status)->where('hirarki', $request->hirarki)
    ->update([
      'status' => 0,
      'approved_keterangan' => $request->keterangan
    ]);

    $cuti_detail_confirm = CutiDetail::where('cuti_id', $request->status)->where('atasan_id', $request->confirm)
      ->update([
        'confirm' => 1
      ]);

    return response()->json([
      'status' => 200,
      'message' => 'sukses'
    ]);
  }

  public function detailApprover(Request $request)
  {
    $cuti_detail = CutiDetail::with('dataAtasan')->where('cuti_id', $request->id)->where('hirarki', $request->hirarki)->get();

    return response()->json([
      'cuti_detail' => $cuti_detail
    ]);
  }
}
