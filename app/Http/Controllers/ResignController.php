<?php

namespace App\Http\Controllers;

use App\Models\HcKontrak;
use App\Models\HcResign;
use App\Models\HcResignCeklis;
use App\Models\HcResignSurveiCeklis;
use App\Models\HcResignSurveiEssay;
use App\Models\MasterKaryawan;
use App\Models\ResignDetail;
use Illuminate\Http\Request;

class ResignController extends Controller
{
    public function index()
    {
        $resign = HcResign::orderBy('id', 'desc')->get();

        return view('pages.resign.index', ['resigns' => $resign]);
    }

    public function show($id)
    {
        $resign = HcResign::with(['masterKaryawan', 'masterJabatan'])->find($id);
        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $resign->id)->get();

        return view('pages.resign.show', [
            'resign' => $resign,
            'resign_ceklis' => $resign_ceklis,
            'resign_survei_ceklis' => $resign_survei_ceklis,
            'resign_survei_essay' => $resign_survei_essay
        ]);
    }

    public function deleteBtn($id)
    {
        $resign = HcResign::find($id);

        return response()->json([
            'id' => $resign->id
        ]);
    }

    public function delete(Request $request)
    {
        $resign = HcResign::find($request->id);

        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $request->id);
        $resign_ceklis->delete();

        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $request->id);
        $resign_survei_ceklis->delete();

        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $request->id);
        $resign_survei_essay->delete();

        $resign_detail = ResignDetail::where('resign_id', $request->id);
        $resign_detail->delete();

        $resign->delete();

        // activity_log($resign, "resign", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function paklaring($id)
    {
        $karyawan = MasterKaryawan::find($id);

        $kontrak_awal = HcKontrak::where('karyawan_id', $id)->first();
        if ($kontrak_awal) {
            $awal = $kontrak_awal->mulai_kontrak;
        } else {
            $awal = "kosong";
        }

        $kontrak_akhir = HcKontrak::where('karyawan_id', $id)->orderBy('id', 'desc')->first();
        if ($kontrak_akhir) {
            $akhir = $kontrak_akhir->akhir_kontrak;
        } else {
            $akhir = "kosong";
        }

        return view('pages.resign.paklaring', [
            'karyawan' => $karyawan,
            'kontrak_awal' => $awal,
            'kontrak_akhir' => $akhir
        ]);
    }
}
