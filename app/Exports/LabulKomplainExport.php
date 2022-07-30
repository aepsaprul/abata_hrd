<?php

namespace App\Exports;

use App\Models\LabulKomplain;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulKomplainExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_komplain', [
            'komplain' => LabulKomplain::get()
        ]);
    }
}
