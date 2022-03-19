<?php

namespace App\Http\Controllers;

use App\Models\HcResign;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanResignController extends Controller
{
    public function index()
    {
        $resign = HcResign::where('master_karyawan_id', Auth::user()->master_karyawan_id)->get();

        return view('pages.pengajuan.resign.index', ['resigns' => $resign]);
    }

    public function create()
    {
        $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

        return response()->json([
            'karyawan' => $karyawan
        ]);
    }

    public function store(Request $request)
    {

    }
}
