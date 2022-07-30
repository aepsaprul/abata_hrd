<?php

namespace App\Exports;

use App\Models\LabulReqor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulReqorExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_reqor', [
            'reqor' => LabulReqor::get()
        ]);
    }
}
