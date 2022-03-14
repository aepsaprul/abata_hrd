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
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 1;
        $cuti_detail->save();

        $hirarki = $cuti_detail->hirarki + 1;

        $total_cuti_detail = count(CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->get());

        if ($hirarki <= $total_cuti_detail) {
            $cuti_detail_next = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->where('hirarki', $hirarki)->first();
            $cuti_detail_next->status = 1;
            $cuti_detail_next->save();
        }

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved($id)
    {
        $cuti_detail = CutiDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
