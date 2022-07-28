<?php

namespace App\Exports;

use App\Models\LabulActivityPlan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulActivityPlanExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_activity_plan', [
            'activity_plan' => LabulActivityPlan::get()
        ]);
    }
}
