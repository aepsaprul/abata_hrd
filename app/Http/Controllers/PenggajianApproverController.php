<?php

namespace App\Http\Controllers;

use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\PenggajianApprover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianApproverController extends Controller
{
    public function index()
    {
        return view('pages.master.penggajian_approver.index');
    }

    public function getPenggajian()
    {
        $approve = PenggajianApprover::with('role')
            ->select(DB::raw('count(hirarki) as hirarki, role_id'))
            ->groupBy('role_id')
            ->orderBy('role_id', 'desc')
            ->get();

        $approve_detail = PenggajianApprover::get();

        $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

        return response()->json([
            'approves' => $approve,
            'approve_details' => $approve_detail,
            'karyawans' => $karyawan
        ]);
    }

    public function create()
    {
        $role = MasterRole::doesntHave('approvePenggajian')->orderBy('hirarki', 'asc')->get();

        return response()->json([
            'roles' => $role
        ]);
    }

    public function store(Request $request)
    {
        $approve = new PenggajianApprover;
        $approve->role_id = $request->role_id;
        $approve->hirarki = 1;
        $approve->atasan_id = json_encode("");
        $approve->save();

        activity_log($approve, "penggajian_approver", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function updateApprover(Request $request)
    {
        $approve = PenggajianApprover::find($request->id);

        // $atasan = json_decode(json_encode($request->atasan_id));
        // $atasan_array = array();
        $atasan_array = [];
        foreach ($request->atasan_id as $key => $value) {
            $data = explode("_", $value);
            $atasan_array[] = $data[0];
        }

        $approve->atasan_id = json_encode($atasan_array);
        $approve->save();

        activity_log($approve, "penggajian_approver", "updated");

        return response()->json([
            'status' => 'true',
            'tes' => $atasan_array
        ]);
    }

    public function addApprover(Request $request)
    {
        $getApprove = PenggajianApprover::where('role_id', $request->role_id)->get();
        $count_hirarki = count($getApprove);

        $approve = new PenggajianApprover;
        $approve->role_id = $request->role_id;
        $approve->hirarki = $count_hirarki + 1;
        $approve->atasan_id = json_encode("");
        $approve->save();

        activity_log($approve, "penggajian_approver", "updated");

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
        $approve = PenggajianApprover::where('role_id', $request->id);
        $approve->delete();

        activity_log($approve, "penggajian_approver", "deleted");

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
        $approve = PenggajianApprover::find($request->id);
        $approve->delete();

        activity_log($approve, "penggajian_approver", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
