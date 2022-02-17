<?php

namespace App\Http\Controllers;

use App\Models\HcTraining;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $training = HcTraining::get();

        return view('pages.training.index', ['trainings' => $training]);
    }
}
