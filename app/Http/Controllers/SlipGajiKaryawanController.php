<?php

namespace App\Http\Controllers;

use App\Models\HcKontrak;
use App\Models\HcSlipGaji;
use App\Models\HcSlipGajiDetail;
use DateTime;
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
        $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', Auth::user()->master_karyawan_id)->first();

        $kontrak = HcKontrak::where('karyawan_id', Auth::user()->master_karyawan_id)->orderBy('id', 'asc')->first();

        // hitung lama kontrak
        if ($kontrak) {
            # code...
            $mulai_kontrak = new DateTime($kontrak->mulai_kontrak);
            $akhir_kontrak = new DateTime(date('Y-m-d'));
            $selisih = $mulai_kontrak->diff($akhir_kontrak);

            if ($selisih->y > 0) {
                if ($selisih->m > 0) {
                    $lama_kontrak = $selisih->y . " Tahun " . $selisih->m . " Bulan";
                } else {
                    $lama_kontrak = $selisih->y . " Tahun ";
                }
            } else {
                $lama_kontrak = $selisih->m . " Bulan";
            }
        } else {
            $lama_kontrak = null;
        }

        $pdf = PDF::loadView('pages.slip_gaji_karyawan.detail', ['slip' => $slip, 'slip_detail' => $slip_detail, 'kontrak' => $kontrak, 'lama_kontrak' => $lama_kontrak]);
        return $pdf->stream();
    }
}
