<?php

namespace App\Http\Controllers;

use App\Models\CutiApprove;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CutiApproveController extends Controller
{
    public function index()
    {
        return view('pages.master.cuti_approve.index');
    }

    public function getCuti()
    {
        $approve = CutiApprove::with('role')
            ->select(DB::raw('count(hirarki) as hirarki, role_id'))
            ->groupBy('role_id')
            ->orderBy('role_id', 'desc')
            ->get();

        $approve_detail = CutiApprove::get();

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
        $approve = new CutiApprove;
        $approve->role_id = $request->role_id;
        $approve->hirarki = 1;
        $approve->atasan_id = json_encode("");
        $approve->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function updateApprove(Request $request)
    {
        $approve = CutiApprove::find($request->id);
        $approve->hirarki = $request->hirarki;
        $approve->atasan_id = json_encode($request->atasan_id);
        $approve->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function addApprove(Request $request)
    {
        $getApprove = CutiApprove::where('role_id', $request->role_id)->get();
        $count_hirarki = count($getApprove);

        $approve = new CutiApprove;
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
        $approve = CutiApprove::where('role_id', $request->id);
        $approve->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtnApprove($id)
    {
        return response()->json([
            'id' => $id
        ]);
    }

    public function deleteApprove(Request $request)
    {
        $approve = CutiApprove::find($request->id);
        $approve->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
