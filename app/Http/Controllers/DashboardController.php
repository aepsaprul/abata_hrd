<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use App\Models\HcKontrak;
use App\Models\HcResign;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan_aktif = MasterKaryawan::where('status', 'aktif')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $karyawan_pria = MasterKaryawan::where('status', 'aktif')->where('jenis_kelamin', 'L')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $karyawan_wanita = MasterKaryawan::where('status', 'aktif')->where('jenis_kelamin', 'P')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        $today = Carbon::today();

        // *karyawan kontrak
        $thirtyDaysLater = Carbon::today()->addDays(30);

        // Mengambil karyawan yang kontrak terakhirnya akan berakhir dalam 30 hari
        $karyawan_kontrak = MasterKaryawan::with(['kontrak' => function($query) use ($today, $thirtyDaysLater) {
        // Ambil kontrak terakhir
        $query->orderBy('akhir_kontrak', 'desc')
            ->whereBetween('akhir_kontrak', [$today, $thirtyDaysLater]);
          }])
          ->where('status', 'Aktif')->get()
          ->map(function ($k) use ($today) {
            // Ambil kontrak terakhir
            $kontrak_terakhir = $k->kontrak->first();

            if ($kontrak_terakhir) {
              $k->akhir_kontrak = $kontrak_terakhir->akhir_kontrak;
              $k->hari_tersisa = Carbon::parse($k->akhir_kontrak)->diffInDays($today);
            }

            return $k;
          });
        
          // Hitung total karyawan yang kontraknya berakhir
          $total_karyawan_kontrak = $karyawan_kontrak->filter(function ($k) {
            return $k->akhir_kontrak !== null;  // Pastikan karyawan memiliki kontrak
          })->count();
        
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
}
