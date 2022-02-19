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

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {

    }

    public function deleteBtn($id)
    {

    }

    public function delete(Request $request)
    {

    }
}
