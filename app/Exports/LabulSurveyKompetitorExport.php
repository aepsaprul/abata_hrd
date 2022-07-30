<?php

namespace App\Exports;

use App\Models\LabulSurveyKompetitor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LabulSurveyKompetitorExport implements FromView
{
    public function view(): View
    {
        return view('pages.labul.result.template_survey_kompetitor', [
            'survey_kompetitor' => LabulSurveyKompetitor::get()
        ]);
    }
}
