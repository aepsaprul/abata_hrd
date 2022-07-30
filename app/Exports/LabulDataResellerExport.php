<?php

namespace App\Exports;

use App\Models\LabulDataReseller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulDataResellerExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_data_reseller', [
            'data_reseller' => LabulDataReseller::get()
        ]);
    }
}
