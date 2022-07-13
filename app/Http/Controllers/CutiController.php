<?php

namespace App\Http\Controllers;

use App\Models\CutiApprover;
use App\Models\CutiDetail;
use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    public function index()
    {
        if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
            $cuti = HcCuti::orderBy('id', 'desc')->get();
        } else {
            $cuti_approvers = CutiApprover::where('atasan_id', 'like', '%'.Auth::user()->master_karyawan_id.'%')->get();
            if (count($cuti_approvers) > 0) {
                $cuti = HcCuti::with('masterKaryawan')
                    ->whereHas('masterKaryawan', function ($query) {
                        $query->where('master_cabang_id', Auth::user()->masterKaryawan->master_cabang_id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $cuti = HcCuti::where('master_karyawan_id', Auth::user()->master_karyawan_id)->orderBy('id', 'desc')->get();
            }
        }

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
    public function create()
    {
        if (Auth::user()->master_karyawan_id == 0) {
            $karyawan = MasterKaryawan::with('masterJabatan')->where('id', 45)->first();
        } else {
            $karyawan = MasterKaryawan::with('masterJabatan')->where('id', Auth::user()->master_karyawan_id)->first();
        }

        $atasans = MasterKaryawan::where('id', '!=', Auth::user()->master_karyawan_id)->get();
        $pengganti = MasterKaryawan::where('id', '!=', Auth::user()->master_karyawan_id)->get();

        return response()->json([
            'karyawan' => $karyawan,
            'atasans' => $atasans,
            'pengganti' => $pengganti
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama harus diisi',
            'karyawan_id.required' => 'karyawan id harus diisi',
            'telepon.required' => 'Telepon harus diisi',
            'telepon.max' => 'Telepon diisi maksimal 15 karakter',
            'jenis.required' => 'Jenis harus diisi',
            'jml_hari.required' => 'Jumlah hari harus diisi',
            'pengganti.required' => 'Pengganti harus diisi',
            'alasan.required' => 'Alasan harus diisi'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'karyawan_id' => 'required',
            'telepon' => 'required|max:15',
            'jenis' => 'required',
            'jml_hari' => 'required',
            'pengganti' => 'required',
            'alasan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            if ($request->jml_hari > $request->sisa_cuti) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->errors(),
                    'error_sisa_cuti' => 'Jumlah hari tidak boleh melebihi dari sisa cuti'
                ]);
            } else {
                if ($request->jenis == "lainnya") {
                    # code...
                    $jenis = "lainnya : " . $request->form_cuti_lainnya;
                } else {
                    $jenis = $request->jenis;
                }

                $cuti = new HcCuti;
                $cuti->master_karyawan_id = $request->karyawan_id;
                $cuti->master_jabatan_id = $request->jabatan_id;
                $cuti->atasan = $request->atasan;
                $cuti->telepon = $request->telepon;
                $cuti->alamat = $request->alamat;
                $cuti->jenis = $jenis;
                $cuti->jml_hari = $request->jml_hari;
                $cuti->karyawan_pengganti = $request->pengganti;
                $cuti->alasan = $request->alasan;
                $cuti->tanggal = date("Y-m-d");
                $cuti->status = 1;
                $cuti->approved_text = "Permohonan Cuti";
                $cuti->approved_percentage = "0";
                $cuti->approved_background = "secondary";
                $cuti->save();

                foreach ($request->cuti_tanggal as $key => $value) {
                    $cuti_tgl = new HcCutiTgl;
                    $cuti_tgl->hc_cuti_id = $cuti->id;
                    $cuti_tgl->tanggal = $value;
                    $cuti_tgl->save();
                }

                $karyawan = MasterKaryawan::find($request->karyawan_id);

                $role = MasterRole::where('nama', $karyawan->role)->first();

                $approve = CutiApprover::where('role_id', $role->id)->get();

                foreach ($approve as $key => $value) {
                    $cuti_detail = new CutiDetail;
                    $cuti_detail->cuti_id = $cuti->id;
                    $cuti_detail->hirarki = $value->hirarki;
                    $cuti_detail->atasan = $value->atasan_id;
                    $cuti_detail->status = 0;
                    $cuti_detail->confirm = 0;
                    $cuti_detail->approved_text = "Permohonan Cuti";
                    $cuti_detail->approved_percentage = "0";
                    $cuti_detail->approved_background = "secondary";
                    $cuti_detail->save();
                }

                $approve_mail = CutiApprover::where('role_id', $role->id)
                    ->where('hirarki', 1)
                    ->first();

                $a = [];
                foreach (json_decode($approve_mail->atasan_id) as $value) {
                    $a[] = $value;
                }

                // $tes = User::whereIn('master_karyawan_id', $a)->get();
                // foreach ($tes as $key => $value) {
                //     # code...
                //     $value->notify(new CutiNotification($value));
                // }

                // activity_log($cuti, "cuti", "created");

                return response()->json([
                    'status' => 200,
                    'message' => "Data berhasil ditambahkan",
                    // 'tes' => $tes
                ]);
            }
        }
    }

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
