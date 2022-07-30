<?php

namespace App\Exports;

use App\Models\LabulReseller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulResellerExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_reseller', [
            'reseller' => LabulReseller::get()
        ]);
    }
}
