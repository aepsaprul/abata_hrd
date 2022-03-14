<?php

namespace App\Http\Controllers;

use App\Models\CutiDetail;
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

    public function approved($id)
    {

    }

    public function disapproved($id)
    {

    }
}
