<?php

namespace App\Http\Controllers;

use App\Models\CutiApprover;
use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\HcResign;
use App\Models\HcResignCeklis;
use App\Models\HcResignSurveiCeklis;
use App\Models\HcResignSurveiEssay;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\ResignDetail;
use App\Models\User;
use App\Notifications\CutiNotification;
use App\Notifications\ResignNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $karyawan_id = Auth::user()->master_karyawan_id;

        $cuti_detail = CutiDetail::with('cuti')->where('atasan', 'like', '%'.$karyawan_id.'%')->get();

        $resign_detail = ResignDetail::with('resign')->where('atasan', 'like', '%'.$karyawan_id.'%')->get();

        return view('pages.approval.index', ['cuti_details' => $cuti_detail, 'resign_details' => $resign_detail]);
    }

    public function show($id)
    {
        $cuti = HcCuti::with('masterKaryawan', 'karyawanPengganti', 'cutiTgl')->find($id);

        return response()->json([
            'cuti' => $cuti
        ]);
    }

    public function approved($id)
    {
        $cuti_detail = CutiDetail::find($id);

        // update status, agar cuti tampil di approver selanjutnya
        $hirarki = $cuti_detail->hirarki + 1;

        $total_cuti_detail = count(CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->get());

        if ($hirarki <= $total_cuti_detail) {
            $cuti_detail_next = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->where('hirarki', $hirarki)->first();
            $cuti_detail_next->status = 1;
            $cuti_detail_next->save();

            $approve_mail = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)
                ->where('hirarki', $hirarki)
                ->first();

            $a = [];
            foreach (json_decode($approve_mail->atasan) as $value) {
                $a[] = $value;
            }

            $tes = User::whereIn('master_karyawan_id', $a)->get();
            foreach ($tes as $key => $value) {
                # code...
                $value->notify(new CutiNotification($value));
            }
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_cuti_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $cuti_detail->status = 1;
        $cuti_detail->confirm = 1;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = $cuti_detail->approved_percentage + $percentage;
        $cuti_detail->approved_background = "primary";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = $cuti->approved_percentage + $percentage;
        $cuti->approved_background = "primary";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved($id)
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $cuti_detail = CutiDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = 100;
        $cuti_detail->approved_background = "danger";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = 100;
        $cuti->approved_background = "danger";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function resignApproved($id)
    {
        $resign_detail = ResignDetail::find($id);

        // update status, agar cuti tampil di approver selanjutnya
        $hirarki = $resign_detail->hirarki + 1;

        $total_resign_detail = count(ResignDetail::where('resign_id', $resign_detail->resign_id)->get());

        if ($hirarki <= $total_resign_detail) {
            $resign_detail_next = ResignDetail::where('resign_id', $resign_detail->resign_id)->where('hirarki', $hirarki)->first();
            $resign_detail_next->status = 1;
            $resign_detail_next->save();

            $approve_mail = ResignDetail::where('resign_id', $resign_detail->resign_id)
                ->where('hirarki', $hirarki)
                ->first();

            $a = [];
            foreach (json_decode($approve_mail->atasan) as $value) {
                $a[] = $value;
            }

            $tes = User::whereIn('master_karyawan_id', $a)->get();
            foreach ($tes as $key => $value) {
                # code...
                $value->notify(new ResignNotification($value));
            }
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_resign_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $resign_detail->status = 1;
        $resign_detail->confirm = 1;
        $resign_detail->approved_date = date('Y-m-d H:i:s');
        $resign_detail->approved_leader = Auth::user()->master_karyawan_id;
        $resign_detail->approved_text = $approved_text;
        $resign_detail->approved_percentage = $resign_detail->approved_percentage + $percentage;
        $resign_detail->approved_background = "primary";
        $resign_detail->save();

        $cuti = HcResign::find($resign_detail->resign_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = $cuti->approved_percentage + $percentage;
        $cuti->approved_background = "primary";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function resignDisapproved($id)
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $cuti_detail = ResignDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = 100;
        $cuti_detail->approved_background = "danger";
        $cuti_detail->save();

        $cuti = HcResign::find($cuti_detail->resign_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = 100;
        $cuti->approved_background = "danger";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function resignShow($id)
    {
        $resign = HcResign::with(['masterKaryawan', 'masterJabatan'])->find($id);
        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $resign->id)->get();

        return view('pages.approval.resign_show', [
            'resign' => $resign,
            'resign_ceklis' => $resign_ceklis,
            'resign_survei_ceklis' => $resign_survei_ceklis,
            'resign_survei_essay' => $resign_survei_essay
        ]);
    }
}
