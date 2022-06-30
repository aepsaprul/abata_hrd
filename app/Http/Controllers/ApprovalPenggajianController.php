<?php

namespace App\Http\Controllers;

use App\Models\HcPenggajian;
use App\Models\MasterKaryawan;
use App\Models\PenggajianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalPenggajianController extends Controller
{
    public function index()
    {
        $karyawan_id = Auth::user()->master_karyawan_id;

        $penggajian_detail = PenggajianDetail::with('penggajian')->where('atasan', 'like', "%\"$karyawan_id\"%")->orderBy('id', 'desc')->get();

        return view('pages.approval_penggajian.index', ['penggajian_details' => $penggajian_detail]);
    }

    public function show($id)
    {
        $penggajian = HcPenggajian::with('masterKaryawan')->find($id);

        return response()->json([
            'penggajian' => $penggajian
        ]);
    }

    public function approved($id)
    {
        $penggajian_detail = PenggajianDetail::find($id);

        // update status, agar penggajian tampil di approver selanjutnya
        $hirarki = $penggajian_detail->hirarki + 1;

        $total_penggajian_detail = count(PenggajianDetail::where('penggajian_id', $penggajian_detail->penggajian_id)->get());

        if ($hirarki <= $total_penggajian_detail) {
            $penggajian_detail_next = PenggajianDetail::where('penggajian_id', $penggajian_detail->penggajian_id)->where('hirarki', $hirarki)->first();
            $penggajian_detail_next->status = 1;
            $penggajian_detail_next->save();
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_penggajian_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $penggajian_detail->status = 1;
        $penggajian_detail->confirm = 1;
        $penggajian_detail->approved_date = date('Y-m-d H:i:s');
        $penggajian_detail->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian_detail->approved_text = $approved_text;
        $penggajian_detail->approved_percentage = $penggajian_detail->approved_percentage + $percentage;
        $penggajian_detail->approved_background = "primary";
        $penggajian_detail->save();

        $penggajian = HcPenggajian::find($penggajian_detail->penggajian_id);
        $penggajian->approved_date = date('Y-m-d H:i:s');
        $penggajian->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian->approved_text = $approved_text;
        $penggajian->approved_percentage = $penggajian->approved_percentage + $percentage;
        $penggajian->approved_background = "primary";
        $penggajian->save();

        // activity_log($penggajian_detail, "penggajian_detail", "approved");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved(Request $request)
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $penggajian_detail = PenggajianDetail::find($request->id);
        $penggajian_detail->status = 1;
        $penggajian_detail->confirm = 2;
        $penggajian_detail->approved_date = date('Y-m-d H:i:s');
        $penggajian_detail->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian_detail->approved_text = $approved_text;
        $penggajian_detail->approved_percentage = 100;
        $penggajian_detail->approved_background = "danger";
        $penggajian_detail->save();

        $penggajian = HcPenggajian::find($penggajian_detail->penggajian_id);
        $penggajian->alasan = $request->alasan;
        $penggajian->approved_date = date('Y-m-d H:i:s');
        $penggajian->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian->approved_text = $approved_text;
        $penggajian->approved_percentage = 100;
        $penggajian->approved_background = "danger";
        $penggajian->save();

        // activity_log($penggajian_detail, "penggajian_detail", "disapproved");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
