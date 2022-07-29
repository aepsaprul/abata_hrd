<?php

namespace App\Exports;

use App\Models\LabulActivityPlan;
use App\Models\LabulActivityPlanDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulActivityPlanExport implements FromView
{
    // public function __construct(int $day)
    // {
    //     $this->day = $day;
    // }

    public function view(): View
    {
        return view('pages.labul.result.template_activity_plan', [
            'activity_plan' => LabulActivityPlan::get()
            // 'activity_plan' => LabulActivityPlan::with('detail')->where('id', $this->day)->get()
        ]);
    }
}
