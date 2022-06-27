<?php

namespace App\Exports;

use App\Models\HcSlipGajiTemplate;
use App\Models\MasterKaryawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TemplateView implements FromView
{
    public function view(): View
    {
        return view('pages.slip_gaji.template', [
            'karyawans' => HcSlipGajiTemplate::orderBy('hirarki_cabang', 'asc')
            ->orderBy('created_at', 'asc')
            ->get()
        ]);
    }

    // public function headings(): array
    // {
    //     return [
    //         ['First row', 'First row'],
    //         [''],
    //         [''],
    //         [
    //             '#',
    //             'User',
    //             'Date',
    //             'nip',
    //             'nama',
    //             'bulan',
    //             'tahun',
    //             'periode',
    //             'gaji_pokok'
    //         ],
    //      ];
    // }

    // public function collection()
    // {
    //     return MasterKaryawan::select(DB::raw('nama_lengkap as nama_lengkap'))->where('status', 'Aktif')->whereNull('deleted_at')->orderBy('master_cabang_id', 'asc')->get();
    // }

    // public function startCell(): string
    // {
    //     return 'A5';
    // }
}
