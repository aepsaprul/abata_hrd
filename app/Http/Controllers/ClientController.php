<?php

namespace App\Http\Controllers;

use App\Models\HcLoker;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $lokers = HcLoker::with('masterJabatan')->get();
        return view('client.index', ['lokers' => $lokers]);
    }

    public function formSyarat()
    {
        return view('client.form-syarat');
    }
}
