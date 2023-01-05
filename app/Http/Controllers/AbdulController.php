<?php

namespace App\Http\Controllers;

use App\Models\AbdulPengajuan;
use Illuminate\Http\Request;

class AbdulController extends Controller
{
  public function index()
  {
    return view('pages.abdul.index');
  }

  public function tampil()
  {
    $pengajuan = AbdulPengajuan::get();

    return view('pages.abdul.tampil', ['pengajuans' => $pengajuan]);
  }

  public function formPengajuan()
  {
    return view('pages.abdul.formPengajuan');
  }

  public function store(Request $request)
  {
    $pinjaman = new AbdulPengajuan;
    $pinjaman->karyawan_id = $request->karyawan_id;
    $pinjaman->nomor = $request->nomor;
    $pinjaman->pinjaman = $request->pinjaman;
    $pinjaman->keperluan = $request->keperluan;
    $pinjaman->gaji = $request->gaji;
    $pinjaman->angsuran = $request->angsuran;
    $pinjaman->metode_bayar = $request->metode_bayar;
    $pinjaman->metode_bayar_des = $request->metode_bayar_des;
    $pinjaman->save();

    return response()->json([
      'status' => $request->all()
    ]);
  }
}
