<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
  public function index()
  {
    $konsultasis = Konsultasi::orderBy('id', 'desc')->limit(500)->get();

    return view('pages.konsultasi.index', ['konsultasis' => $konsultasis]);
  }

  public function create()
  {
    $karyawans = MasterKaryawan::where('status', 'Aktif')->get();

    return view('pages.konsultasi.create', ['karyawans' => $karyawans]);
  }

  public function store(Request $request)
  {
    $karyawan = MasterKaryawan::find($request->karyawan_id);
    $cabang = MasterCabang::find($karyawan->master_cabang_id);
    $jabatan = MasterJabatan::find($karyawan->master_jabatan_id);

    $konsultasi = new Konsultasi;
    $konsultasi->tanggal_pertemuan = $request->tanggal_pertemuan;
    $konsultasi->user_id = Auth::user()->id;
    $konsultasi->karyawan_id = $karyawan->id;
    $konsultasi->nama_karyawan = $karyawan->nama_lengkap;
    $konsultasi->cabang = $cabang->nama_cabang;
    $konsultasi->jabatan = $jabatan->nama_jabatan;
    $konsultasi->waktu_mulai = $request->waktu_mulai;
    $konsultasi->waktu_selesai = $request->waktu_selesai;
    $konsultasi->point = $request->point;
    $konsultasi->catatan = $request->catatan;
    $konsultasi->tindakan = $request->tindakan;
    $konsultasi->save();

    return redirect()->route('konsultasi')->with('message', 'Data berhasil ditambahkan');
  }

  public function show($id)
  {
    $konsultasi = Konsultasi::find($id);

    return view('pages.konsultasi.show', ['konsultasi' => $konsultasi]);
  }

  public function edit($id)
  {
    $konsultasi = Konsultasi::find($id);
    $karyawans = MasterKaryawan::where('status', 'Aktif')->get();

    return view('pages.konsultasi.edit', [
      'konsultasi' => $konsultasi,
      'karyawans' => $karyawans
    ]);
  }

  public function update(Request $request, $id)
  {
    $karyawan = MasterKaryawan::find($request->karyawan_id);
    $cabang = MasterCabang::find($karyawan->master_cabang_id);
    $jabatan = MasterJabatan::find($karyawan->master_jabatan_id);

    $konsultasi = Konsultasi::find($id);
    $konsultasi->tanggal_pertemuan = $request->tanggal_pertemuan;
    $konsultasi->user_id = Auth::user()->id;
    $konsultasi->karyawan_id = $karyawan->id;
    $konsultasi->nama_karyawan = $karyawan->nama_lengkap;
    $konsultasi->cabang = $cabang->nama_cabang;
    $konsultasi->jabatan = $jabatan->nama_jabatan;
    $konsultasi->waktu_mulai = $request->waktu_mulai;
    $konsultasi->waktu_selesai = $request->waktu_selesai;
    $konsultasi->point = $request->point;
    $konsultasi->catatan = $request->catatan;
    $konsultasi->tindakan = $request->tindakan;
    $konsultasi->save();

    return redirect()->route('konsultasi')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $konsultasi = Konsultasi::find($id);
    $konsultasi->delete();

    return redirect()->route('konsultasi')->with('message', 'Data berhasil dihapus');
  }
}
