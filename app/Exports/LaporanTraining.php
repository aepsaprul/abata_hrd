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
    $tahun = $this->tahun;
    $bulan = $this->bulan;

    return view('pages.training.templateLaporan', [
      'tahun' => $this->tahun,
      'bulan' => $this->bulan,
      'trainings' => Training::whereYear('tanggal', $this->tahun)->whereMonth('tanggal', $this->bulan)->get(),
      'pesertas' => TrainingPeserta::whereHas('dataTraining', function ($q) use ($tahun, $bulan) {
          $q->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan);
        })->get()
    ]);
  }
}
