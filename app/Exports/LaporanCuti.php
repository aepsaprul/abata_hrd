<?php

namespace App\Exports;

use App\Models\HcCuti;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanCuti implements FromView
{
  public function __construct($start_date, $end_date)
  {
    $this->start_date = $start_date;
    $this->end_date = $end_date;
  }

  public function view(): View
  {
    return view('pages.cuti.templateLaporan', [
      // 'cutis' => HcCuti::whereBetween('created_at', [$this->start_date, $this->end_date])->get()
      'cutis' => DB::table('hc_cutis')
        ->join('master_karyawans', 'hc_cutis.master_karyawan_id', '=', 'master_karyawans.id')
        ->join('master_cabangs', 'master_karyawans.master_cabang_id', '=', 'master_cabangs.id')
        ->join('hc_cuti_tgls', 'hc_cutis.id', '=', 'hc_cuti_tgls.hc_cuti_id')
        ->select(
          'master_karyawans.nama_lengkap',
          'master_cabangs.nama_cabang',
          'hc_cutis.alasan',
          DB::raw('COUNT(hc_cuti_tgls.id) as totalcuti'),
          'master_karyawans.total_cuti',
          'hc_cuti_tgls.tanggal',
          'hc_cutis.created_at'
        )
        ->whereBetween('hc_cuti_tgls.tanggal', [$this->start_date, $this->end_date])
        ->groupBy(
          'hc_cutis.id',
          'master_karyawans.nama_lengkap',
          'master_cabangs.nama_cabang',
          'hc_cutis.alasan',
          'master_karyawans.total_cuti',
          'hc_cuti_tgls.tanggal'
        )
        // ->where('status_approve', 'complete')
        ->orderBy('hc_cuti_tgls.tanggal', 'ASC')
        ->get()
    ]);
  }
}
