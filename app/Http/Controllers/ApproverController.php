<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approver;
use App\Models\ApproverDetail;
use App\Models\Karyawan;
use App\Models\MasterRole;
use App\Models\MasterKaryawan;

class ApproverController extends Controller
{
  public function index()
  {
    $approver_cuti = Approver::where('jenis', 'cuti')
      ->with(['dataDetail' => function($query) {
        $query->orderBy('hirarki', 'asc');
      }])
      ->get();
      
    $approver_resign = Approver::where('jenis', 'resign')
    ->with(['dataDetail' => function($query) {
      $query->orderBy('hirarki', 'asc');
    }])
    ->get();

    $approver_penggajian = Approver::where('jenis', 'penggajian')
    ->with(['dataDetail' => function($query) {
      $query->orderBy('hirarki', 'asc');
    }])
    ->get();

    $approver_direktur = Approver::where('jenis', 'direktur')
    ->with(['dataDetail' => function($query) {
      $query->orderBy('hirarki', 'asc');
    }])
    ->get();

    return view('pages.master.approver.index', [
      'approver_cutis' => $approver_cuti,
      'approver_resigns' => $approver_resign,
      'approver_penggajians' => $approver_penggajian,
      'approver_direkturs' => $approver_direktur
    ]);
  }

  public function data(Request $request)
  {
    $approver = Approver::with(['dataRole', 'dataDetail' => function($query) {
        $query->orderBy('hirarki', 'asc');
      }, 'dataDetail.dataKaryawan'])
      ->where('jenis', $request->jenis)
      ->get();

    return response()->json([
      'approvers' => $approver
    ]);
  }

  public function create(Request $request)
  {
    $role = MasterRole::whereDoesntHave('dataApprover', function ($query) use ($request) {
        $query->where('jenis', $request->jenis);
      })
      ->get();

    return response()->json([
      'roles' => $role,
      'jenis' => $request->jenis
    ]);
  }

  public function store(Request $request)
  {
    $approver = new Approver;
    $approver->jenis = $request->jenis;
    $approver->role_id = $request->role_id;
    $approver->save();

    return response()->json([
      'status' => 200,
      'message' => 'sukses',
      'jenis' => $request->jenis
    ]);
  }

  public function createApprover($id)
  {
    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

    return response()->json([
      'id' => $id,
      'karyawans' => $karyawan
    ]);
  }

  public function storeApprover(Request $request)
  {
    $approver = $request->approver_id;
    $karyawan = $request->karyawan;
    $hirarki = $request->hirarki;

    $approvers = Approver::find($approver);

    for ($i=0; $i < count($karyawan); $i++) { 
      $approver_detail = new ApproverDetail;
      $approver_detail->approver_id = $approver;
      $approver_detail->hirarki = $hirarki[$i];
      $approver_detail->karyawan_id = $karyawan[$i];
      $approver_detail->save();
    }

    return response()->json([
      'status' => 200,
      'message' => 'sukses',
      'jenis' => $approvers->jenis
    ]);
  }

  public function delete($id)
  {
    $approver = Approver::find($id);
    
    if ($approver->dataDetail) {
      $approver_detail = ApproverDetail::where('approver_id', $approver->id);
      $approver_detail->delete();
    }

    $approver->delete();

    return response()->json([
      'status' => 200,
      'message' => 'sukses',
      'jenis' => $approver->jenis
    ]);
  }

  public function deleteAllApproverDetail($id)
  {
    $approver_detail = ApproverDetail::where('approver_id', $id);
    $approver_detail->delete();

    $approvers = Approver::find($id);

    return response()->json([
      'status' => 200,
      'message' => 'sukses',
      'jenis' => $approvers->jenis
    ]);
  }
}
