<?php

namespace App\Http\Controllers;

use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\ResignApprover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResignApproverController extends Controller
{
    public function index()
    {
        return view('pages.master.resign_approver.index');
    }

    public function getResign()
    {
        $approve = ResignApprover::with('role')
            ->select(DB::raw('count(hirarki) as hirarki, role_id'))
            ->groupBy('role_id')
            ->orderBy('role_id', 'desc')
            ->get();

        $approve_detail = ResignApprover::get();

        $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

        return response()->json([
            'approves' => $approve,
            'approve_details' => $approve_detail,
            'karyawans' => $karyawan
        ]);
    }

    public function create()
    {
        $role = MasterRole::doesntHave('approveResign')->orderBy('hirarki', 'asc')->get();

        return response()->json([
            'roles' => $role
        ]);
    }

    public function store(Request $request)
    {
        $approve = new ResignApprover;
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
        $approve = ResignApprover::find($request->id);

        // $atasan = json_decode(json_encode($request->atasan_id));
        // $atasan_array = array();
        $atasan_array = [];
        foreach ($request->atasan_id as $key => $value) {
            $data = explode("_", $value);
            $atasan_array[] = $data[0];
        }

        $approve->atasan_id = json_encode($atasan_array);
        $approve->save();

        return response()->json([
            'status' => 'true',
            'tes' => $atasan_array
        ]);
    }

    public function addApprover(Request $request)
    {
        $getApprove = ResignApprover::where('role_id', $request->role_id)->get();
        $count_hirarki = count($getApprove);

        $approve = new ResignApprover;
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
        $approve = ResignApprover::where('role_id', $request->id);
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
        $approve = ResignApprover::find($request->id);
        $approve->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
