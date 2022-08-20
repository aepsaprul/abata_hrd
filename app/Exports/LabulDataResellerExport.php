<?php

namespace App\Exports;

use App\Models\LabulDataReseller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulDataResellerExport implements FromView
{
    public function __construct($startDate, $endDate, $cabang_id)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->cabang_id = $cabang_id;
    }

    public function view(): View
    {
        if ($this->cabang_id == "") {
            return view('pages.labul.result.template_data_reseller', [
                'data_reseller' => LabulDataReseller::whereBetween('created_at', [$this->startDate, $this->endDate])
                    ->get()
            ]);
        } else {
            return view('pages.labul.result.template_data_reseller', [
                'data_reseller' => LabulDataReseller::whereBetween('created_at', [$this->startDate, $this->endDate])
                    ->where('cabang_id', $this->cabang_id)
                    ->get()
            ]);
        }
    }
}
