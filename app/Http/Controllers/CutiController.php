<?php

namespace App\Http\Controllers;

use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = HcCuti::get();

        return view('pages.cuti.index', ['cutis' => $cuti]);
    }

    public function show($id)
    {
        $cuti = HcCuti::with('masterKaryawan', 'karyawanPengganti', 'cutiTgl')->find($id);

        return response()->json([
            'cuti' => $cuti
        ]);
    }

    public function deleteBtn($id)
    {
        $cuti = HcCuti::find($id);

        return response()->json([
            'id' => $cuti->id
        ]);
    }

    public function delete(Request $request)
    {
        $cuti = HcCuti::find($request->id);

        $cuti_detail = CutiDetail::where('cuti_id', $cuti->id);
        $cuti_detail->delete();

        $cuti_tgl = HcCutiTgl::where('hc_cuti_id', $cuti->id);
        $cuti_tgl->delete();

        $cuti->delete();

        // activity_log($cuti, "cuti", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
