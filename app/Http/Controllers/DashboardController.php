<?php

namespace App\Http\Controllers;

use App\Exports\RekapKaryawanExport;
use App\Models\HcCuti;
use App\Models\HcKontrak;
use App\Models\HcResign;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
  public function index()
  {
    $karyawan_aktif = MasterKaryawan::where('status', 'aktif')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
    $karyawan_pria = MasterKaryawan::where('status', 'aktif')->where('jenis_kelamin', 'L')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
    $karyawan_wanita = MasterKaryawan::where('status', 'aktif')->where('jenis_kelamin', 'P')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

    // Ambil data karyawan yang kontraknya akan habis dalam 20 hari
    $today = now()->toDateString(); // Tanggal hari ini

    $karyawan_kontrak = DB::table('hc_kontraks')
      ->select('master_karyawans.nama_lengkap', 'hc_kontraks.akhir_kontrak', 'hc_kontraks.mulai_kontrak', DB::raw('DATEDIFF(hc_kontraks.akhir_kontrak, CURDATE()) as sisa_hari'))
      ->join('master_karyawans', 'master_karyawans.id', '=', 'hc_kontraks.karyawan_id')
      ->where('master_karyawans.status', 'Aktif') // Kondisi untuk karyawan aktif
      ->whereRaw('DATEDIFF(hc_kontraks.akhir_kontrak, CURDATE()) <= 60') // Sisa hari ≤ 20
      ->whereRaw('DATEDIFF(hc_kontraks.akhir_kontrak, CURDATE()) >= 0')  // Sisa hari ≥ 0
      ->whereIn('hc_kontraks.id', function ($query) {
        $query->select(DB::raw('MAX(id)'))->from('hc_kontraks')->groupBy('karyawan_id');
      })
      ->orderBy('hc_kontraks.akhir_kontrak', 'asc')
      ->get();
      
    // Hitung total karyawan yang kontraknya hampir habis
    $total_karyawan_kontrak = $karyawan_kontrak->count();
    
    // *karyawan lewat habis kontrak
    // Mengambil karyawan yang kontrak terakhirnya sudah lewat
    $karyawan_lewat_kontrak = MasterKaryawan::with(['kontrak' => function($query) {
      // Urutkan berdasarkan tanggal akhir kontrak secara descending untuk mendapatkan kontrak terakhir
      $query->orderBy('akhir_kontrak', 'desc');
    }])
    ->where('status', 'Aktif')->get()
    ->filter(function ($k) use ($today) {
      $kontrak_terakhir = $k->kontrak->first(); // Ambil kontrak terakhir

      if ($kontrak_terakhir) {
        $kontrak_sudah_lewat = Carbon::parse($kontrak_terakhir->akhir_kontrak)->isPast(); // Cek apakah kontrak sudah lewat
        $tidak_ada_kontrak_baru = !$k->kontrak->where('mulai_kontrak', '>', $kontrak_terakhir->akhir_kontrak)->count(); // Cek apakah ada kontrak baru

        return $kontrak_sudah_lewat && $tidak_ada_kontrak_baru;
      }

      return false;
    });

    // Hitung total karyawan yang kontraknya sudah lewat tanpa kontrak baru
    $total_karyawan_lewat_kontrak = $karyawan_lewat_kontrak->count();

    $count_karyawan_aktif = count($karyawan_aktif);

    $karyawan_nonaktif = MasterKaryawan::where('status', 'nonaktif')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
    $count_karyawan_nonaktif = count($karyawan_nonaktif);

    $cuti = HcCuti::where('status_approve', '!=', 'complete')->orderBy('id', 'desc')->get();
    $count_cuti = count($cuti);

    $resign = HcResign::where('status_approve', '!=', 'complete')->orderBy('id', 'desc')->get();
    $count_resign = count($resign);

    return view('pages.dashboard.index', [
      'karyawan_aktif' => $karyawan_aktif,
      'count_karyawan_aktif' => $count_karyawan_aktif,
      'karyawan_pria' => $karyawan_pria,
      'karyawan_wanita' => $karyawan_wanita,
      'karyawan_nonaktif' => $karyawan_nonaktif,
      'count_karyawan_nonaktif' => $count_karyawan_nonaktif,
      'cuti' => $cuti,
      'count_cuti' => $count_cuti,
      'resign' => $resign,
      'count_resign' => $count_resign,
      'karyawan_kontraks' => $karyawan_kontrak,
      'total_karyawan_kontrak' => $total_karyawan_kontrak,
      'karyawan_lewat_kontraks' => $karyawan_lewat_kontrak,
      'total_karyawan_lewat_kontrak' => $total_karyawan_lewat_kontrak
    ]);
  }

  public function getTotalKaryawanPerBulan()
  {
    $year = Carbon::now()->year;
    $monthlyCounts = [];

    for ($month = 1; $month <= Carbon::now()->month; $month++) {
      // Set tanggal ke hari terakhir bulan tersebut
      $lastDayOfMonth = Carbon::create($year, $month)->endOfMonth();
      
      // Hitung jumlah karyawan pada akhir bulan tersebut
      $count = MasterKaryawan::where('status', 'Aktif')->whereDate('created_at', '<=', $lastDayOfMonth)->count();
      $monthlyCounts[] = $count;
    }

    return response()->json($monthlyCounts);
  }

  public function show($id)
  {
    $karyawan = MasterKaryawan::find($id);
    $karyawan_kontrak = HcKontrak::where('karyawan_id', $id)->get();

    return response()->json([
      'karyawan' => $karyawan,
      'karyawan_kontraks' => $karyawan_kontrak
    ]);
  }

  public function store(Request $request)
  {
    $karyawan = new HcKontrak;
    $karyawan->karyawan_id = $request->id;
    $karyawan->mulai_kontrak = $request->mulai_kontrak;
    $karyawan->akhir_kontrak = $request->akhir_kontrak;
    $karyawan->lama_kontrak = $request->lama_kontrak;
    $karyawan->save();

    return response()->json([
      'status' => 'true'
    ]);
  }

  public function rekap()
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

      // Hitung karyawan dengan masa kerja lebih dari 6 bulan
      // $bpjs_tk = $cabang->masterKaryawan->filter(fn($k) => $this->masaKerjaLebihDariEnamBulan($k->created_at))->count();
      // $bpjs_kesehatan = $bpjs_tk; // Asumsinya BPJS TK dan Kesehatan diberikan bersama

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

    return view('pages.dashboard.rekap', compact('laporan', 'total'));
  }

  private function calculateAge($birthdate)
  {
    return Carbon::parse($birthdate)->age;
  }

  private function masaKerjaLebihDariEnamBulan($tanggal_masuk)
  {
    return Carbon::parse($tanggal_masuk)->diffInMonths(now()) > 6;
  }

  public function rekapDownload()
  {
    return Excel::download(new RekapKaryawanExport, 'rekap.xlsx');
  }
}
