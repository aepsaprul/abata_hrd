<?php

namespace App\Exports;

use App\Models\LabulDataInstansi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulDataInstansiExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_data_instansi', [
            'data_instansi' => LabulDataInstansi::get()
        ]);
    }
}
