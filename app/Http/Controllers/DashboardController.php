<?php

namespace App\Http\Controllers;

use App\Exports\RekapKaryawanExport;
use App\Exports\RekapKontrakExport;
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
    $laporan = MasterKaryawan::with('kontrak')
      ->where('status', 'Aktif')
      ->get();

    return view('pages.dashboard.rekap', ['kontraks' => $laporan]);
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
  
  public function rekapKontrakDownload()
  {
    return Excel::download(new RekapKontrakExport, 'rekap_kontrak.xlsx');
  }
}
