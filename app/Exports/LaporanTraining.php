<?php

namespace App\Exports;

use App\Models\Training;
use App\Models\TrainingPeserta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanTraining implements FromView
{
  public function __construct($tahun, $bulan)
  {
    $this->tahun = $tahun;
    $this->bulan = $bulan;
  }

  public function view(): View
  {
    return view('pages.training.templateLaporan', [
      'tahun' => $this->tahun,
      'bulan' => $this->bulan,
      'trainings' => Training::whereYear('created_at', $this->tahun)->whereMonth('created_at', $this->bulan)->get(),
      'pesertas' => TrainingPeserta::with('dataTraining')->whereYear('created_at', $this->tahun)->whereMonth('created_at', $this->bulan)->get()
    ]);
  }
}
