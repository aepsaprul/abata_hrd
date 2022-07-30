<?php

namespace App\Exports;

use App\Models\LabulInstansi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulInstansiExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_instansi', [
            'instansi' => LabulInstansi::get()
        ]);
    }
}
