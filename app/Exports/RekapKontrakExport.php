<?php

namespace App\Exports;

use App\Models\MasterKaryawan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class RekapKontrakExport implements FromView
{
  public function view(): View
  {
    return view('pages.karyawan.template_rekap_kontrak', [
      'kontraks' => MasterKaryawan::with('kontrak')
        ->where('status', 'Aktif')
        ->get()
    ]);
  }
}
