<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproveController extends Controller
{
    public function index()
    {
        $role = Auth::user()->masterKaryawan->role;
        $cuti = HcCuti::with('cutiDetail')->whereHas('cutiDetail', function ($query) use ($role) {
            $query->where('atasan', 'like', '%'.$role.'%');
        })->get();

        return view('pages.approve.index', ['cutis' => $cuti]);
    }
}
