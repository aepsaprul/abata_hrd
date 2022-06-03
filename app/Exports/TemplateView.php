<?php

namespace App\Exports;

use App\Models\MasterKaryawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TemplateView implements FromView
{
    public function view(): View
    {
        return view('pages.slip_gaji.template', [
            'karyawans' => MasterKaryawan::where('status', 'Aktif')->whereNull('deleted_at')->orderBy('master_cabang_id', 'asc')->get()
        ]);
    }
}
