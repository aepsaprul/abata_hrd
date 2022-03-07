<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = HcCuti::get();

        return view('pages.cuti.index', ['cutis' => $cuti]);
    }

    public function show($id)
    {
        $cuti = HcCuti::with(['masterKaryawan', 'atasanLangsung', 'masterJabatan'])->find($id);
        $karyawan = MasterKaryawan::where('id', $cuti->atasan)->first();
        $karyawanPengganti = MasterKaryawan::where('id', $cuti->karyawan_pengganti)->first();
        $cuti_tgls = HcCutiTgl::where('hc_cuti_id', $cuti->id)->get();

        return response()->json([
            'cuti' => $cuti,
            'karyawan' => $karyawan,
            'karyawan_pengganti' => $karyawanPengganti,
            'cuti_tgls' => $cuti_tgls
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
        $cuti->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function atasanApprove($id)
    {
        $cuti = HcCuti::find($id);
        $cuti->status = 2;
        $cuti->tanggal_approve_atasan = date("Y-m-d H:i:s");
        $cuti->save();

        return redirect()->route('cuti.index')->with('status', 'Cuti Di Approve');
    }

    public function atasanTolak($id)
    {
        $cuti = HcCuti::find($id);
        $cuti->status = 3;
        $cuti->tanggal_approve_atasan = date("Y-m-d H:i:s");
        $cuti->save();

        return redirect()->route('cuti.index')->with('status', 'Cuti Di Tolak');
    }

    public function hcApprove($id)
    {
        $cuti = HcCuti::find($id);
        $cuti->status = 4;
        $cuti->tanggal_approve_hc = date("Y-m-d H:i:s");
        $cuti->save();

        $karyawan = MasterKaryawan::find($cuti->master_karyawan_id);
        $total_cuti = $karyawan->total_cuti;
        $jml_cuti = $cuti->jml_hari;

        $sisa_cuti = $total_cuti - $jml_cuti;

        $update_cuti_karyawan = MasterKaryawan::where('id', $cuti->master_karyawan_id)->first();
        $update_cuti_karyawan->total_cuti = $sisa_cuti;
        $update_cuti_karyawan->save();


        return redirect()->route('cuti.index')->with('status', 'Cuti Di Approve');
    }

    public function hcTolak($id)
    {
        $cuti = HcCuti::find($id);
        $cuti->status = 5;
        $cuti->tanggal_approve_hc = date("Y-m-d H:i:s");
        $cuti->save();

        return redirect()->route('cuti.index')->with('status', 'Cuti Di Tolak');
    }
}
