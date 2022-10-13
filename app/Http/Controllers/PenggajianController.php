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
use Illuminate\Support\Facades\File;

class PenggajianController extends Controller
{
    public function index()
    {
        $karyawan_id = Auth::user()->master_karyawan_id;
        $penggajian = HcPenggajian::with(['masterKaryawan', 'penggajianDetail'])
            ->orderBy('id', 'desc')
            ->get();

        $penggajian_detail = PenggajianDetail::with('penggajian')->where('atasan', 'like', "%\"$karyawan_id\"%")->orderBy('id', 'desc')->get();

        return view('pages.penggajian.index', [
            'penggajians' => $penggajian,
            'penggajian_details' => $penggajian_detail
        ]);
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

        // dev
        if($request->hasFile('create_file')) {
            $file = $request->file('create_file');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move('public/file/pengajuan/', $filename);
            $penggajian->file = $filename;
        }
        // prod
        // if($request->hasFile('create_file')) {
        //   $file = $request->file('create_file');
        //   $extension = $file->getClientOriginalExtension();
        //   $filename = $file->getClientOriginalName();
        //   $file->move('file/pengajuan/', $filename);
        //   $penggajian->file = $filename;
        // }

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

        // $tes = User::whereIn('master_karyawan_id', $a)->get();
        // foreach ($tes as $key => $value) {
        //     # code...
        //     $value->notify(new PenggajianNotification($value));
        // }

        // activity_log($penggajian, "penggajian", "created");

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

        // dev
        if (file_exists("public/file/penggajuan/" . $penggajian->file)) {
            File::delete("public/file/penggajuan/" . $penggajian->file);
        }
        // prod
        // if (file_exists("file/penggajuan/" . $penggajian->file)) {
        //   File::delete("file/penggajuan/" . $penggajian->file);
        // }

        // activity_log($penggajian, "penggajian", "deleted");

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }

    public function approved($id)
    {
        $penggajian_detail = PenggajianDetail::find($id);

        // update status, agar penggajian tampil di approver selanjutnya
        $hirarki = $penggajian_detail->hirarki + 1;

        $total_penggajian_detail = count(PenggajianDetail::where('penggajian_id', $penggajian_detail->penggajian_id)->get());

        if ($hirarki <= $total_penggajian_detail) {
            $penggajian_detail_next = PenggajianDetail::where('penggajian_id', $penggajian_detail->penggajian_id)->where('hirarki', $hirarki)->first();
            $penggajian_detail_next->status = 1;
            $penggajian_detail_next->save();
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_penggajian_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $penggajian_detail->status = 1;
        $penggajian_detail->confirm = 1;
        $penggajian_detail->approved_date = date('Y-m-d H:i:s');
        $penggajian_detail->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian_detail->approved_text = $approved_text;
        $penggajian_detail->approved_percentage = $penggajian_detail->approved_percentage + $percentage;
        $penggajian_detail->approved_background = "primary";
        $penggajian_detail->save();

        $penggajian = HcPenggajian::find($penggajian_detail->penggajian_id);
        $penggajian->approved_date = date('Y-m-d H:i:s');
        $penggajian->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian->approved_text = $approved_text;
        $penggajian->approved_percentage = $penggajian->approved_percentage + $percentage;
        $penggajian->approved_background = "primary";
        $penggajian->save();

        // activity_log($penggajian_detail, "penggajian_detail", "approved");

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

        $penggajian_detail = PenggajianDetail::find($request->id);
        $penggajian_detail->status = 1;
        $penggajian_detail->confirm = 2;
        $penggajian_detail->approved_date = date('Y-m-d H:i:s');
        $penggajian_detail->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian_detail->approved_text = $approved_text;
        $penggajian_detail->approved_percentage = 100;
        $penggajian_detail->approved_background = "danger";
        $penggajian_detail->save();

        $penggajian = HcPenggajian::find($penggajian_detail->penggajian_id);
        $penggajian->alasan = $request->alasan;
        $penggajian->approved_date = date('Y-m-d H:i:s');
        $penggajian->approved_leader = Auth::user()->master_karyawan_id;
        $penggajian->approved_text = $approved_text;
        $penggajian->approved_percentage = 100;
        $penggajian->approved_background = "danger";
        $penggajian->save();

        // activity_log($penggajian_detail, "penggajian_detail", "disapproved");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
