<?php

namespace App\Http\Controllers;

use App\Models\HcResign;
use App\Models\HcResignCeklis;
use App\Models\HcResignSurveiCeklis;
use App\Models\HcResignSurveiEssay;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;

class ResignController extends Controller
{
    public function index()
    {
        $resign = HcResign::get();

        return view('pages.resign.index', ['resigns' => $resign]);
    }

    public function show($id)
    {
        $resign = HcResign::with(['masterKaryawan', 'masterJabatan'])->find($id);
        $atasan = MasterKaryawan::find($resign->atasan);
        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $resign->id)->get();

        return response()->json([
            'resign' => $resign,
            'atasan' => $atasan,
            'resign_ceklis' => $resign_ceklis,
            'resign_survei_ceklis' => $resign_survei_ceklis,
            'resign_survei_essay' => $resign_survei_essay
        ]);
    }

    public function deleteBtn($id)
    {

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

        $resign->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function atasanApprove($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 2;
        $resign->tanggal_approve_atasan = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Approve'
        ]);
    }

    public function atasanTolak($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 3;
        $resign->tanggal_approve_atasan = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Tolak'
        ]);
    }

    public function hcApprove($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 4;
        $resign->tanggal_approve_hc = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Approve'
        ]);
    }

    public function hcTolak($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 5;
        $resign->tanggal_approve_hc = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Tolak'
        ]);
    }

    public function direkturApprove($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 6;
        $resign->tanggal_approve_direktur = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Approve'
        ]);
    }

    public function direkturTolak($id)
    {
        $resign = HcResign::find($id);
        $resign->status = 7;
        $resign->tanggal_approve_direktur = date("Y-m-d H:i:s");
        $resign->save();

        return response()->json([
            'status', 'Resign Di Tolak'
        ]);
    }
}
