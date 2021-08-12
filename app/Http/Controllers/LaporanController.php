<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AntrianPengunjung;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pengunjung()
    {
        $antrianPengungjung = AntrianPengunjung::where('status', '!=', 0)
            ->with([
                'masterKaryawan',
                'masterCabang'
                ])
            ->get();
        return view('laporan.pengunjung', ['pengunjungs' => $antrianPengungjung]);
    }

    public function pengunjungJson()
    {
        $antrianPengungjungs = AntrianPengunjung::select(DB::raw('count(nama_customer) AS jml'), DB::raw('tanggal'))
        ->groupBy(DB::raw('DATE(tanggal)'))
        ->get();
        
        $a = [];

        foreach ($antrianPengungjungs as $key => $value) {
            # code...
            $a[] = $value->jml;
        }
        // return $a;
        return response()->json(
            $a
        );
    }
}
