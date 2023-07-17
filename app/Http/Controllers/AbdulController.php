<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AbdulApprover;
use App\Models\AbdulPengajuan;
use App\Models\AbdulPengajuanApprover;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbdulController extends Controller
{
  public function index()
  {
    if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
      $pengajuan = AbdulPengajuan::orderBy('id', 'desc')->limit(30)->get();
    } else {
      $pengajuan_approvers = AbdulApprover::where('atasan_id', 'like', '%'.Auth::user()->master_karyawan_id.'%')->get();
      if (count($pengajuan_approvers) > 0) {
        $pengajuan = AbdulPengajuan::with('karyawan')
          ->whereHas('karyawan', function ($query) {
              $query->where('master_cabang_id', Auth::user()->masterKaryawan->master_cabang_id);
          })
          ->orderBy('id', 'desc')
          ->limit(30)
          ->get();
      } else {
        $pengajuan = AbdulPengajuan::where('karyawan_id', Auth::user()->master_karyawan_id)
          ->orderBy('id', 'desc')
          ->limit(30)
          ->get();
      }
    }

    $karyawan = MasterKaryawan::get();

    return view('pages.abdul.index', [
      'pengajuans' => $pengajuan,
      'karyawans' => $karyawan
    ]);
  }
  public function show($id)
  {
    $pengajuan = AbdulPengajuan::find($id);

    return view('pages.abdul.show', ['pengajuan' => $pengajuan]);
  }
  public function create()
  {
    $user = User::with(['masterKaryawan', 'masterKaryawan.masterCabang'])->find(Auth::user()->id);

    if (!$user->master_karyawan_id) {
      return "Cabang Kosong";
    }

    // nomor pengajuan
    $cabang = MasterCabang::find($user->masterKaryawan->master_cabang_id);
    $alias = $cabang->alias;
    $cabang_id = $cabang->id;

    $pengajuan = AbdulPengajuan::whereHas('karyawan', function ($query) use ($cabang_id) {
      $query->where('master_cabang_id', $cabang_id);
    })
    ->max('urutan');

    $urutan = $pengajuan + 1;
    $nomor_urut = sprintf("%04s", $urutan);

    $array_bulan = array(
      1 => "I", 
      2 => "II",
      3 => "III",
      4 => "IV",
      5 => "V",
      6 => "VI",
      7 => "VII",
      8 => "VIII",
      9 => "IX",
      10 => "X",
      11 => "XI",
      12 => "XII"
    );

    $bulan = $array_bulan[date('n')];
    $tahun = date('Y');

    $nomor_pengajuan = $alias."/".$nomor_urut."/SP3/ABATAPEDULI/".$bulan."/".$tahun;

    return view('pages.abdul.create', [
      'user' => $user,
      'urutan' => $urutan,
      'nomor_pengajuan' => $nomor_pengajuan
    ]);
  }
  public function store(Request $request)
  {
    $nominal_angsuran = str_replace(".", "", $request->pinjaman) / $request->angsuran;

    $pinjaman = new AbdulPengajuan;
    $pinjaman->karyawan_id = $request->karyawan_id;
    $pinjaman->urutan = $request->urutan;
    $pinjaman->nama = $request->nama;
    $pinjaman->jabatan = $request->jabatan;
    $pinjaman->alamat = $request->alamat;
    $pinjaman->telepon = $request->telepon;
    $pinjaman->nomor = $request->nomor;
    $pinjaman->cabang = $request->cabang;
    $pinjaman->pinjaman = str_replace(".", "", $request->pinjaman);
    $pinjaman->keperluan = $request->keperluan;
    $pinjaman->gaji = str_replace(".", "", $request->gaji);
    $pinjaman->angsuran = $request->angsuran;
    $pinjaman->nominal_angsuran = $nominal_angsuran;
    $pinjaman->metode_bayar = "gaji";
    $pinjaman->tanggal_bayar = date($request->tahunBayar.'-'.$request->bulanBayar.'-28');
    $pinjaman->save();

    $karyawan = MasterKaryawan::find($request->karyawan_id);

    $role = MasterRole::where('nama', $karyawan->role)->first();

    $approve = AbdulApprover::where('role_id', $role->id)->get();

    foreach ($approve as $key => $value) {
      $cuti_detail = new AbdulPengajuanApprover;
      $cuti_detail->pengajuan_id = $pinjaman->id;
      $cuti_detail->hirarki = $value->hirarki;
      $cuti_detail->atasan = $value->atasan_id;
      $cuti_detail->status = 0;
      $cuti_detail->confirm = 0;
      $cuti_detail->approved_text = "Pengajuan Pinjaman";
      $cuti_detail->approved_percentage = "0";
      $cuti_detail->approved_background = "secondary";
      $cuti_detail->save();
    }

    return redirect()->route('abdul');
  }
  public function delete(Request $request)
  {
    $abdul = AbdulPengajuan::find($request->id);

    $pengajuan_approver = AbdulPengajuanApprover::where('pengajuan_id', $abdul->id);
    $pengajuan_approver->delete();

    $abdul->delete();

    return response()->json([
      'status' => 200
    ]);
  }
  
  // approver
  public function approver()
  {
    return view('pages.abdul.approver');
  }
  public function approverData()
  {
    $approver = AbdulApprover::with('role')
      ->select(DB::raw('count(hirarki) as hirarki, role_id'))
      ->groupBy('role_id')
      ->orderBy('role_id', 'desc')
      ->get();

    $approver_all = AbdulApprover::get();

    $karyawan = MasterKaryawan::where('status', 'Aktif')->get();

    return response()->json([
      'approvers' => $approver,
      'approve_alls' => $approver_all,
      'karyawans' => $karyawan
    ]);
  }
  public function approverCreate()
  {
    $role = MasterRole::doesntHave('approveAbdul')->orderBy('hirarki', 'asc')->get();

    return response()->json([
      'roles' => $role
    ]);
  }
  public function approverStore(Request $request)
  {
    $approve = new AbdulApprover;
    $approve->role_id = $request->role_id;
    $approve->hirarki = 1;
    $approve->atasan_id = json_encode([""]);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverUpdate(Request $request)
  {
    $approve = AbdulApprover::find($request->id);

    $atasan_array = [];
    foreach ($request->atasan_id as $key => $value) {
        $data = explode("_", $value);
        $atasan_array[] = $data[0];
    }

    $approve->atasan_id = json_encode($atasan_array);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverAdd(Request $request)
  {
    $getApprove = AbdulApprover::where('role_id', $request->role_id)->get();
    $count_hirarki = count($getApprove);

    $approve = new AbdulApprover;
    $approve->role_id = $request->role_id;
    $approve->hirarki = $count_hirarki + 1;
    $approve->atasan_id = json_encode([""]);
    $approve->save();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverDeleteAllBtn($id)
  {
    return response()->json([
      'id' => $id
    ]);
  }
  public function approverDeleteAll(Request $request)
  {
    $approve = AbdulApprover::where('role_id', $request->id);
    $approve->delete();

    return response()->json([
      'status' => 200
    ]);
  }
  public function approverDeleteBtn($id)
  {
    return response()->json([
      'id' => $id
    ]);
  }
  public function approverDelete(Request $request)
  {
    $approve = AbdulApprover::find($request->id);
    $approve->delete();

    return response()->json([
      'status' => 200
    ]);
  }

  // approved
  public function approved(Request $request)
  {
    $abdul_pengajuan_approver = AbdulPengajuanApprover::find($request->id);

    // update status, agar cuti tampil di approver selanjutnya
    $hirarki = $abdul_pengajuan_approver->hirarki + 1;

    $total_pengajuan_approver = count(AbdulPengajuanApprover::where('pengajuan_id', $abdul_pengajuan_approver->pengajuan_id)->get());

    if ($hirarki <= $total_pengajuan_approver) {
      $abdul_pengajuan_approver_next = AbdulPengajuanApprover::where('pengajuan_id', $abdul_pengajuan_approver->pengajuan_id)->where('hirarki', $hirarki)->first();
      $abdul_pengajuan_approver_next->status = 1;
      $abdul_pengajuan_approver_next->save();
    }
    // end

    // hitung persentase progress
    $percentage = ceil(100 / $total_pengajuan_approver);
    // end

    $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
    if ($karyawan->jenis_kelamin == "L") {
      $approved_text = "Approved Oleh Pak";
    } else {
      $approved_text = "Approved Oleh Bu";
    }

    $abdul_pengajuan_approver->status = 1;
    $abdul_pengajuan_approver->confirm = 1;
    $abdul_pengajuan_approver->approved_date = date('Y-m-d H:i:s');
    $abdul_pengajuan_approver->approved_leader = Auth::user()->master_karyawan_id;
    $abdul_pengajuan_approver->approved_text = $approved_text;
    $abdul_pengajuan_approver->approved_percentage = $abdul_pengajuan_approver->approved_percentage + $percentage;
    $abdul_pengajuan_approver->approved_background = "primary";
    $abdul_pengajuan_approver->approved_keterangan = $request->keterangan;
    $abdul_pengajuan_approver->save();

    $pengajuan = AbdulPengajuan::find($abdul_pengajuan_approver->pengajuan_id);
    $pengajuan->approved_date = date('Y-m-d H:i:s');
    $pengajuan->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan->approved_text = $approved_text;
    $pengajuan->approved_percentage = $pengajuan->approved_percentage + $percentage;
    $pengajuan->approved_background = "primary";
    $pengajuan->save();

    $percentage_result = $pengajuan->approved_percentage + $percentage;

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

    $pengajuan_approver = AbdulPengajuanApprover::find($request->id);
    $pengajuan_approver->status = 1;
    $pengajuan_approver->confirm = 2;
    $pengajuan_approver->approved_date = date('Y-m-d H:i:s');
    $pengajuan_approver->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan_approver->approved_text = $approved_text;
    $pengajuan_approver->approved_percentage = 100;
    $pengajuan_approver->approved_background = "danger";
    $pengajuan_approver->approved_keterangan = $request->keterangan;
    $pengajuan_approver->save();

    $pengajuan = AbdulPengajuan::find($pengajuan_approver->pengajuan_id);
    $pengajuan->approved_date = date('Y-m-d H:i:s');
    $pengajuan->approved_leader = Auth::user()->master_karyawan_id;
    $pengajuan->approved_text = $approved_text;
    $pengajuan->approved_percentage = 100;
    $pengajuan->approved_background = "danger";
    $pengajuan->save();

    return response()->json([
      'status' => 'true'
    ]);
  }

  // sp3
  public function sp3($id)
  {
    $pengajuan = AbdulPengajuan::find($id);

    return view('pages.abdul.sp3', ['pengajuan' => $pengajuan]);
  }
  public function akad($id)
  {
    $pengajuan = AbdulPengajuan::find($id);

    return view('pages.abdul.akad', ['pengajuan' => $pengajuan]);
  }
}
