<?php

namespace App\Http\Controllers;

use App\Models\HcKontrak;
use App\Models\HcSlipGaji;
use App\Models\HcSlipGajiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class SlipGajiKaryawanController extends Controller
{
    public function index()
    {
        $slip = HcSlipGaji::get();

        return view('pages.slip_gaji_karyawan.index', ['slips' => $slip]);
    }

    public function cetakPdf($id)
    {
        // return view('pages.slip_gaji_karyawan.detail');

        // return view('pages.slip_gaji_karyawan.detail');

        $slip = HcSlipGaji::find($id);
        // $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', Auth::user()->master_karyawan_id)->first();
        $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', '12')->first();

        $kontrak = HcKontrak::where('karyawan_id', '12')->orderBy('id', 'asc')->first();

        $pdf = PDF::loadView('pages.slip_gaji_karyawan.detail', ['slip' => $slip, 'slip_detail' => $slip_detail, 'kontrak' => $kontrak]);
        return $pdf->stream();
    }
}
