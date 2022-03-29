<?php

namespace App\Http\Controllers;

use App\Models\HcPenggajian;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\PenggajianApprover;
use App\Models\PenggajianDetail;
use App\Models\User;
use App\Notifications\PenggajianNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = HcPenggajian::with('masterKaryawan')->orderBy('id', 'desc')->get();
        return view('pages.penggajian.index', ['penggajians' => $penggajian]);
    }

    public function store(Request $request)
    {
        if ($request->status == "baru") {
            $status = "Gaji Payroll Bulan " . $request->bulan . " " . $request->tahun;
        } else {
            $status = "Revisi Payroll Bulan " . $request->bulan . " " . $request->tahun;
        }
        $penggajian = new HcPenggajian;
        $penggajian->karyawan_id = Auth::user()->masterKaryawan->id;
        $penggajian->judul = $status;
        $penggajian->tanggal_upload = date('Y-m-d H:i:s');
        $penggajian->status = 1;
        $penggajian->status_bar = "50%";

        if($request->hasFile('create_file')) {
            $file = $request->file('create_file');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move('file/pengajuan/', $filename);
            $penggajian->file = $filename;
        }

        $penggajian->approved_text = "Permohonan Penggajian";
        $penggajian->approved_percentage = "0";
        $penggajian->approved_background = "secondary";
        $penggajian->save();

        $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

        $role = MasterRole::where('nama', $karyawan->role)->first();

        $approve = PenggajianApprover::where('role_id', $role->id)->get();

        foreach ($approve as $key => $value) {
            $penggajian_detail = new PenggajianDetail;
            $penggajian_detail->penggajian_id = $penggajian->id;
            $penggajian_detail->hirarki = $value->hirarki;
            $penggajian_detail->atasan = $value->atasan_id;
            $penggajian_detail->status = 0;
            $penggajian_detail->confirm = 0;
            $penggajian_detail->approved_text = "Permohonan Penggajian";
            $penggajian_detail->approved_percentage = "0";
            $penggajian_detail->approved_background = "secondary";
            $penggajian_detail->save();
        }

        $approve_mail = PenggajianApprover::where('role_id', $role->id)
            ->where('hirarki', 1)
            ->first();

        $a = [];
        foreach (json_decode($approve_mail->atasan_id) as $value) {
            $a[] = $value;
        }

        $tes = User::whereIn('master_karyawan_id', $a)->get();
        foreach ($tes as $key => $value) {
            # code...
            $value->notify(new PenggajianNotification($value));
        }

        activity_log($penggajian, "penggajian", "created");

        return response()->json([
            'status' => 'true',
            'tes' => $request->all()
        ]);
    }

    public function deleteBtn($id)
    {
        $penggajian = HcPenggajian::find($id);

        return response()->json([
            'id' => $penggajian->id
        ]);
    }

    public function delete(Request $request)
    {
        $penggajian = HcPenggajian::find($request->id);
        $penggajian->delete();

        $penggajian_detail = PenggajianDetail::where('penggajian_id', $request->id);
        $penggajian_detail->delete();

        activity_log($penggajian, "penggajian", "deleted");

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
