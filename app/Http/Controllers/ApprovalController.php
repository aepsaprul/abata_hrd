<?php

namespace App\Http\Controllers;

use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $role = Auth::user()->masterKaryawan->role;

        $cuti_detail = CutiDetail::with('cuti')->where('atasan', 'like', '%'.$role.'%')->get();

        return view('pages.approval.index', ['cuti_details' => $cuti_detail]);
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
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_cuti_detail);
        // end

        $cuti_detail->status = 1;
        $cuti_detail->confirm = 1;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = "Approved";
        $cuti_detail->approved_percentage = $cuti_detail->approved_percentage + $percentage;
        $cuti_detail->approved_background = "primary";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = "Approved";
        $cuti->approved_percentage = $cuti->approved_percentage + $percentage;
        $cuti->approved_background = "primary";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved($id)
    {
        $cuti_detail = CutiDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = "Disapproved";
        $cuti_detail->approved_percentage = 100;
        $cuti_detail->approved_background = "danger";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = "Dispproved";
        $cuti->approved_percentage = 100;
        $cuti->approved_background = "danger";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
