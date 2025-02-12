<?php

namespace App\Exports;

use App\Models\MasterCabang;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class RekapKaryawanExport implements FromView
{
  public function view(): View
  {
    $laporan = MasterCabang::with(['masterKaryawan' => function ($query) {
      $query->where('status', 'Aktif'); // Tambahkan filter status aktif
    }, 'masterKaryawan.dataPendidikan'])->where('urutan_rekap', '>', 0)->orderBy('urutan_rekap', 'asc')->get()->map(function ($cabang) {
      $jumlah_l = $cabang->masterKaryawan->where('jenis_kelamin', 'L')->count();
      $jumlah_p = $cabang->masterKaryawan->where('jenis_kelamin', 'P')->count();
      $jumlah_sd = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'SD')->count();
      $jumlah_smp = $cabang->masterKaryawan->flatMap->dataPendidikan->whereIn('tingkat', ['SMP', 'MTS'])->count();
      $jumlah_sma = $cabang->masterKaryawan->flatMap->dataPendidikan->whereIn('tingkat', ['SMA', 'SMK', 'SMA/SMK', 'SMA/SMK/MA'])->count();
      $jumlah_d1 = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'D1')->count();
      $jumlah_d2 = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'D2')->count();
      $jumlah_d3 = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'D3')->count();
      $julmah_s1 = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'S1')->count();
      $julmah_s2 = $cabang->masterKaryawan->flatMap->dataPendidikan->where('tingkat', 'S2')->count();

      return [
        'cabang' => $cabang->nama_cabang,
        'jumlah_l' => $jumlah_l,
        'jumlah_p' => $jumlah_p,
        'total_karyawan' => $jumlah_l + $jumlah_p,
        'jumlah_sd' => $jumlah_sd,
        'jumlah_smp' => $jumlah_smp,
        'jumlah_sma' => $jumlah_sma,
        'jumlah_d1' => $jumlah_d1,
        'jumlah_d2' => $jumlah_d3,
        'jumlah_d3' => $jumlah_d3,
        'jumlah_s1' => $julmah_s1,
        'jumlah_s2' => $julmah_s2,
        'total_pendidikan' => $jumlah_sd + $jumlah_smp + $jumlah_sma + $jumlah_d1 + $jumlah_d2 + $jumlah_d3 + $julmah_s1 + $julmah_s2,
        'jumlah_belum_kawin' => $cabang->masterKaryawan->where('status_perkawinan', 'lajang')->count(),
        'jumlah_kawin' => $cabang->masterKaryawan->where('status_perkawinan', 'menikah')->count(),
        'jumlah_duda' => $cabang->masterKaryawan
          ->where('status_perkawinan', 'cerai')
          ->where('jenis_kelamin', 'L')
          ->count(),
        'jumlah_janda' => $cabang->masterKaryawan
          ->where('status_perkawinan', 'cerai')
          ->where('jenis_kelamin', 'P')
          ->count(),
        'usia_17_23' => $cabang->masterKaryawan
          ->filter(fn($k) => $this->calculateAge($k->tanggal_lahir) >= 17 && $this->calculateAge($k->tanggal_lahir) <= 23)
          ->count(),
        'usia_24_30' => $cabang->masterKaryawan
          ->filter(fn($k) => $this->calculateAge($k->tanggal_lahir) >= 24 && $this->calculateAge($k->tanggal_lahir) <= 30)
          ->count(),
        'usia_31_40' => $cabang->masterKaryawan
          ->filter(fn($k) => $this->calculateAge($k->tanggal_lahir) >= 31 && $this->calculateAge($k->tanggal_lahir) <= 40)
          ->count(),
        'usia_41_55' => $cabang->masterKaryawan
          ->filter(fn($k) => $this->calculateAge($k->tanggal_lahir) >= 41 && $this->calculateAge($k->tanggal_lahir) <= 55)
          ->count(),
        'usia_56_keatas' => $cabang->masterKaryawan
          ->filter(fn($k) => $this->calculateAge($k->tanggal_lahir) >= 56)
          ->count(),
        'bpjs_tk_belum' => $cabang->masterKaryawan->where('bpjs_tk', 'belum')->count(),
        'bpjs_tk_sudah' => $cabang->masterKaryawan->where('bpjs_tk', 'sudah')->count(),
        'bpjs_kes_belum' => $cabang->masterKaryawan->where('bpjs_kes', 'belum')->count(),
        'bpjs_kes_sudah' => $cabang->masterKaryawan->where('bpjs_kes', 'sudah')->count(),
      ];
    });

    // Hitung total semua kolom
    $total = [
      'jumlah_l' => $laporan->sum('jumlah_l'),
      'jumlah_p' => $laporan->sum('jumlah_p'),
      'total_karyawan' => $laporan->sum('total_karyawan'),
      'jumlah_sd' => $laporan->sum('jumlah_sd'),
      'jumlah_smp' => $laporan->sum('jumlah_smp'),
      'jumlah_sma' => $laporan->sum('jumlah_sma'),
      'jumlah_d1' => $laporan->sum('jumlah_d1'),
      'jumlah_d2' => $laporan->sum('jumlah_d2'),
      'jumlah_d3' => $laporan->sum('jumlah_d3'),
      'jumlah_s1' => $laporan->sum('jumlah_s1'),
      'jumlah_s2' => $laporan->sum('jumlah_s2'),
      'total_pendidikan' => $laporan->sum('total_pendidikan'),
      'jumlah_belum_kawin' => $laporan->sum('jumlah_belum_kawin'),
      'jumlah_kawin' => $laporan->sum('jumlah_kawin'),
      'jumlah_duda' => $laporan->sum('jumlah_duda'),
      'jumlah_janda' => $laporan->sum('jumlah_janda'),
      'usia_17_23' => $laporan->sum('usia_17_23'),
      'usia_24_30' => $laporan->sum('usia_24_30'),
      'usia_31_40' => $laporan->sum('usia_31_40'),
      'usia_41_55' => $laporan->sum('usia_41_55'),
      'usia_56_keatas' => $laporan->sum('usia_56_keatas'),
      'bpjs_tk_belum' => $laporan->sum('bpjs_tk_belum'),
      'bpjs_tk_sudah' => $laporan->sum('bpjs_tk_sudah'),
      'bpjs_kes_belum' => $laporan->sum('bpjs_kes_belum'),
      'bpjs_kes_sudah' => $laporan->sum('bpjs_kes_sudah'),
    ];

    return view('pages.karyawan.template_rekap_karyawan', compact('laporan', 'total'));
  }

  private function calculateAge($birthdate)
  {
    return Carbon::parse($birthdate)->age;
  }
}
