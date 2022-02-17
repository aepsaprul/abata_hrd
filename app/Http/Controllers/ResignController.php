<?php

namespace App\Http\Controllers;

use App\Models\HcResign;
use Illuminate\Http\Request;

class ResignController extends Controller
{
    public function index()
    {
        $resign = HcResign::get();

        return view('pages.resign.index', ['resigns' => $resign]);
    }
}
