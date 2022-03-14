<?php

namespace App\Http\Controllers;

use App\Models\CutiApprove;
use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproveController extends Controller
{
    public function index()
    {
        $role = Auth::user()->masterKaryawan->role;

        $role_id = MasterRole::where('nama', $role)->first();

        // $approval = CutiApprove::where('role_id', $role_id->id)->get();


        // $cuti = HcCuti::with('cutiDetail')->whereHas('cutiDetail', function ($query) use ($role) {
        //     $query->where('atasan', 'like', '%'.$role.'%');
        // })->get();

        // $cuti = HcCuti::get();

        $cuti_detail = CutiDetail::with('cuti')->where('atasan', 'like', '%'.$role.'%')->get();

        // dd($cuti_detail);
        return view('pages.approve.index', ['cuti_details' => $cuti_detail]);
    }

    public function approve($id)
    {

    }

    public function disapprove($id)
    {

    }
}
