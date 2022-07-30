<?php

namespace App\Exports;

use App\Models\LabulOmzet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulOmzetExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_omzet', [
            'omzet' => LabulOmzet::get()
        ]);
    }
}
