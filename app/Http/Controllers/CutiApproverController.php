<?php

namespace App\Http\Controllers;

use App\Models\CutiApprover;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CutiApproverController extends Controller
{
    public function index()
    {
        return view('pages.master.cuti_approver.index');
    }

    public function getCuti()
    {
        $approve = CutiApprover::with('role')
            ->select(DB::raw('count(hirarki) as hirarki, role_id'))
            ->groupBy('role_id')
            ->orderBy('role_id', 'desc')
            ->get();

        $approve_detail = CutiApprover::get();

        $role = MasterRole::get();

        return response()->json([
            'approves' => $approve,
            'approve_details' => $approve_detail,
            'roles' => $role
        ]);
    }

    public function create()
    {
        $role = MasterRole::doesntHave('approve')->orderBy('hirarki', 'asc')->get();

        return response()->json([
            'roles' => $role
        ]);
    }

    public function store(Request $request)
    {
        $approve = new CutiApprover;
        $approve->role_id = $request->role_id;
        $approve->hirarki = 1;
        $approve->atasan_id = json_encode("");
        $approve->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function updateApprover(Request $request)
    {
        $approve = CutiApprover::find($request->id);
        $approve->hirarki = $request->hirarki;
        $approve->atasan_id = json_encode($request->atasan_id);
        $approve->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function addApprover(Request $request)
    {
        $getApprove = CutiApprover::where('role_id', $request->role_id)->get();
        $count_hirarki = count($getApprove);

        $approve = new CutiApprover;
        $approve->role_id = $request->role_id;
        $approve->hirarki = $count_hirarki + 1;
        $approve->atasan_id = json_encode("");
        $approve->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        return response()->json([
            'id' => $id
        ]);
    }

    public function delete(Request $request)
    {
        $approve = CutiApprover::where('role_id', $request->id);
        $approve->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtnApprover($id)
    {
        return response()->json([
            'id' => $id
        ]);
    }

    public function deleteApprover(Request $request)
    {
        $approve = CutiApprover::find($request->id);
        $approve->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
