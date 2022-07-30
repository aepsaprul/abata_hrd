<?php

namespace App\Exports;

use App\Models\LabulDataMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulDataMemberExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_data_member', [
            'data_member' => LabulDataMember::get()
        ]);
    }
}
