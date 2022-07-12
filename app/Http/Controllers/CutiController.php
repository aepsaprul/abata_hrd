<?php

namespace App\Http\Controllers;

use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = HcCuti::orderBy('id', 'desc')->get();
        $karyawan = MasterKaryawan::get();

        return view('pages.cuti.index', [
            'cutis' => $cuti,
            'karyawans' => $karyawan
        ]);
    }

    public function show($id)
    {
        $cuti = HcCuti::with('masterKaryawan', 'karyawanPengganti', 'cutiTgl')->find($id);

        return response()->json([
            'cuti' => $cuti
        ]);
    }

    public function deleteBtn($id)
    {
        $cuti = HcCuti::find($id);

        return response()->json([
            'id' => $cuti->id
        ]);
    }

    public function delete(Request $request)
    {
        $cuti = HcCuti::find($request->id);

        $cuti_detail = CutiDetail::where('cuti_id', $cuti->id);
        $cuti_detail->delete();

        $cuti_tgl = HcCutiTgl::where('hc_cuti_id', $cuti->id);
        $cuti_tgl->delete();

        $cuti->delete();

        // activity_log($cuti, "cuti", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }

    // cuti
    public function approved($id)
    {
        $cuti_detail = CutiDetail::find($id);

        // update status, agar cuti tampil di approver selanjutnya
        $hirarki = $cuti_detail->hirarki + 1;

        $total_cuti_detail = count(CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->get());

        if ($hirarki <= $total_cuti_detail) {
            $cuti_detail_next = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->where('hirarki', $hirarki)->first();
            $cuti_detail_next->status = 1;
            $cuti_detail_next->save();

            $approve_mail = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)
                ->where('hirarki', $hirarki)
                ->first();

            $a = [];
            foreach (json_decode($approve_mail->atasan) as $value) {
                $a[] = $value;
            }

            // $tes = User::whereIn('master_karyawan_id', $a)->get();
            // foreach ($tes as $key => $value) {
            //     # code...
            //     $value->notify(new CutiNotification($value));
            // }
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_cuti_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $cuti_detail->status = 1;
        $cuti_detail->confirm = 1;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = $cuti_detail->approved_percentage + $percentage;
        $cuti_detail->approved_background = "primary";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = $cuti->approved_percentage + $percentage;
        $cuti->approved_background = "primary";
        $cuti->save();

        $percentage_result = $cuti->approved_percentage + $percentage;

        // mengurangi cuti
        if ($percentage_result >= 100) {
            $karyawan_cuti = MasterKaryawan::where('id', $cuti->master_karyawan_id)->first();
            $karyawan_cuti->total_cuti = $karyawan_cuti->total_cuti - $cuti->jml_hari;
            $karyawan_cuti->save();
        }

        // activity_log($cuti_detail, "cuti_detail", "approved");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved($id)
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $cuti_detail = CutiDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->master_karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = 100;
        $cuti_detail->approved_background = "danger";
        $cuti_detail->save();

        $cuti = HcCuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = 100;
        $cuti->approved_background = "danger";
        $cuti->save();

        // activity_log($cuti_detail, "cuti_detail", "disapproved");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
