<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AntrianPengunjung;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $antrianPengungjungs = AntrianPengunjung::select(DB::raw('count(nama_customer) AS jml'), DB::raw('tanggal'))
        ->groupBy(DB::raw('DATE(tanggal)'))
        ->get();
        
        $jml = [];
        $tgl = [];
        
        foreach ($antrianPengungjungs as $key => $value) {
            # code...
            $jml[] = $value->jml;
            $tgl[] = $value->tanggal;
        }
        


        $label = $tgl;
        $data = $jml;
        return view('home',compact('data','label'));
        // return view('home');
    }
}
