<?php

namespace App\Http\Controllers;

use App\Events\EventPengajuan;
use App\Models\HcKontrak;
use App\Models\HcResign;
use App\Models\HcResignCeklis;
use App\Models\HcResignSurveiCeklis;
use App\Models\HcResignSurveiEssay;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\ResignApprover;
use App\Models\ResignDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResignController extends Controller
{
    public function index()
    {
        // $resign = HcResign::orderBy('id', 'desc')->get();
        if (Auth::user()->master_karyawan_id == 0 || Auth::user()->masterKaryawan->master_cabang_id == 1) {
            $resign = HcResign::orderBy('id', 'desc')->get();
        } else {
            $resign_approvers = ResignApprover::where('atasan_id', 'like', '%'.Auth::user()->master_karyawan_id.'%')->get();
            if (count($resign_approvers) > 0) {
                $resign = HcResign::with('masterKaryawan')
                    ->whereHas('masterKaryawan', function ($query) {
                        $query->where('master_cabang_id', Auth::user()->masterKaryawan->master_cabang_id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $resign = HcResign::where('master_karyawan_id', Auth::user()->master_karyawan_id)->orderBy('id', 'desc')->get();
            }
        }

        $karyawan = MasterKaryawan::get();

        return view('pages.resign.index', [
            'resigns' => $resign,
            'karyawans' => $karyawan
        ]);
    }

    public function create()
    {
        if (Auth::user()->master_karyawan_id == 0) {
            $nama_karyawan = MasterKaryawan::find(45);
        } else {
            $nama_karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);
        }

        $karyawans = MasterKaryawan::get();
        $jabatans = MasterJabatan::get();
        $cabangs = MasterCabang::get();

        $kontrak = HcKontrak::where('karyawan_id', $nama_karyawan->id)->first();

        if ($kontrak) {
            $tanggal_masuk = $kontrak->mulai_kontrak;
        } else {
            $tanggal_masuk = "";
        }



        return view('pages.resign.create', [
            'nama_karyawan' => $nama_karyawan,
            'karyawans' => $karyawans,
            'jabatans' => $jabatans,
            'cabangs' => $cabangs,
            'tanggal_masuk' => $tanggal_masuk
        ]);
    }

    public function store(Request $request)
    {
        $resigns = new HcResign;
        $resigns->master_karyawan_id = $request->master_karyawan_id;
        $resigns->master_jabatan_id = $request->master_jabatan_id;
        $resigns->lokasi_kerja = $request->lokasi_kerja;
        $resigns->tanggal_masuk = $request->tanggal_masuk;
        $resigns->tanggal_keluar = $request->tanggal_keluar;
        $resigns->alamat = $request->alamat;
        $resigns->telepon = $request->telepon;
        $resigns->status = 1;
        $resigns->approved_text = "Permohonan Resign";
        $resigns->approved_percentage = "0";
        $resigns->approved_background = "secondary";
        $resigns->save();

        if ($request->resign_ceklis_lain == "tidak") {
            $ceklis_lain = "tidak";
        } else {
            $ceklis_lain = $request->resign_ceklis_lain;
        }


        $data_ceklis = [
            $request->resign_ceklis_kewajiban_keuangan,
            $request->resign_ceklis_serah_terima,
            $request->resign_ceklis_id_card,
            $request->resign_ceklis_seragam_karyawan,
            $request->resign_ceklis_laptop,
            $request->resign_ceklis_peralatan_kantor,
            $request->resign_ceklis_penghapusan_akun,
            $request->resign_ceklis_penghapusan_chat,
            $request->resign_ceklis_penutupan_rekening,
            $ceklis_lain,
        ];

        foreach ($request->resign_ceklis as $key => $value) {
            # code...
            $resign_ceklis = new HcResignCeklis;
            $resign_ceklis->hc_resign_id = $resigns->id;
            $resign_ceklis->nama_ceklis = $value;
            $resign_ceklis->keterangan = $data_ceklis[$key];
            $resign_ceklis->tanggal_selesai = $request->resign_ceklis_tanggal[$key];
            $resign_ceklis->save();
        }

        $data_survei_ceklis = [
            $request->resign_survei_ceklis_keterangan_1,
            $request->resign_survei_ceklis_keterangan_2,
            $request->resign_survei_ceklis_keterangan_3,
            $request->resign_survei_ceklis_keterangan_4,
            $request->resign_survei_ceklis_keterangan_5,
            $request->resign_survei_ceklis_keterangan_6,
            $request->resign_survei_ceklis_keterangan_7,
            $request->resign_survei_ceklis_keterangan_8,
            $request->resign_survei_ceklis_keterangan_9,
            $request->resign_survei_ceklis_keterangan_10,
            $request->resign_survei_ceklis_keterangan_11,
            $request->resign_survei_ceklis_keterangan_12,
            $request->resign_survei_ceklis_keterangan_13,
            $request->resign_survei_ceklis_keterangan_14,
            $request->resign_survei_ceklis_keterangan_15,
            $request->resign_survei_ceklis_keterangan_16,
            $request->resign_survei_ceklis_keterangan_17,
            $request->resign_survei_ceklis_keterangan_18,
            $request->resign_survei_ceklis_keterangan_19,
            $request->resign_survei_ceklis_keterangan_20,
            $request->resign_survei_ceklis_keterangan_21,
            $request->resign_survei_ceklis_keterangan_22,
            $request->resign_survei_ceklis_keterangan_23,
            $request->resign_survei_ceklis_keterangan_24,
            $request->resign_survei_ceklis_keterangan_25,
            $request->resign_survei_ceklis_keterangan_26,
            $request->resign_survei_ceklis_keterangan_27,
        ];

        foreach ($request->hc_resign_survei_nama_ceklis_id as $key => $value) {
            $survei_ceklis = new HcResignSurveiCeklis;
            $survei_ceklis->hc_resign_id = $resigns->id;
            $survei_ceklis->nama_ceklis = $value;
            $survei_ceklis->keterangan = $data_survei_ceklis[$key];
            $survei_ceklis->save();
        }

        if ($request->resign_survei_essay_1 == "pindah") {
            $resign_survei_essay_1 = "Pindah ke Perusahaan lain yaitu: " . $request->pindah_perusahaan;
        } elseif ($request->resign_survei_essay_1 == "lainnya") {
            $resign_survei_essay_1 = $request->teks_lainnya;
        } else {
            $resign_survei_essay_1 = $request->resign_survei_essay_1;
        }

        $data_survei_essay = [
            $resign_survei_essay_1,
            $request->resign_survei_essay_2,
            $request->essay_radio . $request->resign_survei_essay_3,
            $request->resign_survei_essay_4,
        ];

        foreach ($request->hc_resign_survei_nama_essay_id as $key => $value) {
            $survei_essay = new HcResignSurveiEssay;
            $survei_essay->hc_resign_id = $resigns->id;
            $survei_essay->nama_essay = $value;
            $survei_essay->keterangan = $data_survei_essay[$key];
            $survei_essay->save();
        }

        $karyawan = MasterKaryawan::find($request->master_karyawan_id);

        $role = MasterRole::where('nama', $karyawan->role)->first();

        $approve = ResignApprover::where('role_id', $role->id)->get();

        foreach ($approve as $key => $value) {
            $resign_detail = new ResignDetail;
            $resign_detail->resign_id = $resigns->id;
            $resign_detail->hirarki = $value->hirarki;
            $resign_detail->atasan = $value->atasan_id;
            $resign_detail->status = 0;
            $resign_detail->confirm = 0;
            $resign_detail->approved_text = "Permohonan Resign";
            $resign_detail->approved_percentage = "0";
            $resign_detail->approved_background = "secondary";
            $resign_detail->save();
        }

        $approve_mail = ResignApprover::where('role_id', $role->id)
                ->where('hirarki', 1)
                ->first();

        $a = [];
        foreach (json_decode($approve_mail->atasan_id) as $value) {
            $a[] = $value;
        }

        // $tes = User::whereIn('master_karyawan_id', $a)->get();
        // foreach ($tes as $key => $value) {
        //     # code...
        //     $value->notify(new ResignNotification($value));
        // }

        // activity_log($resigns, "resign", "created");

        event(new EventPengajuan("resign"));

        return redirect()->route('resign.index')->with('status', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $resign = HcResign::with(['masterKaryawan', 'masterJabatan'])->find($id);
        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $resign->id)->get();
        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $resign->id)->get();

        return view('pages.resign.show', [
            'resign' => $resign,
            'resign_ceklis' => $resign_ceklis,
            'resign_survei_ceklis' => $resign_survei_ceklis,
            'resign_survei_essay' => $resign_survei_essay
        ]);
    }

    public function deleteBtn($id)
    {
        $resign = HcResign::find($id);

        return response()->json([
            'id' => $resign->id
        ]);
    }

    public function delete(Request $request)
    {
        $resign = HcResign::find($request->id);

        $resign_ceklis = HcResignCeklis::where('hc_resign_id', $request->id);
        $resign_ceklis->delete();

        $resign_survei_ceklis = HcResignSurveiCeklis::where('hc_resign_id', $request->id);
        $resign_survei_ceklis->delete();

        $resign_survei_essay = HcResignSurveiEssay::where('hc_resign_id', $request->id);
        $resign_survei_essay->delete();

        $resign_detail = ResignDetail::where('resign_id', $request->id);
        $resign_detail->delete();

        $resign->delete();

        // activity_log($resign, "resign", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function resignApproved($id)
    {
        $resign_detail = ResignDetail::find($id);

        // update status, agar cuti tampil di approver selanjutnya
        $hirarki = $resign_detail->hirarki + 1;

        $total_resign_detail = count(ResignDetail::where('resign_id', $resign_detail->resign_id)->get());

        if ($hirarki <= $total_resign_detail) {
            $resign_detail_next = ResignDetail::where('resign_id', $resign_detail->resign_id)->where('hirarki', $hirarki)->first();
            $resign_detail_next->status = 1;
            $resign_detail_next->save();

            $approve_mail = ResignDetail::where('resign_id', $resign_detail->resign_id)
                ->where('hirarki', $hirarki)
                ->first();

            $a = [];
            foreach (json_decode($approve_mail->atasan) as $value) {
                $a[] = $value;
            }

            // $tes = User::whereIn('master_karyawan_id', $a)->get();
            // foreach ($tes as $key => $value) {
            //     # code...
            //     $value->notify(new ResignNotification($value));
            // }
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_resign_detail);
        // end

        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $resign_detail->status = 1;
        $resign_detail->confirm = 1;
        $resign_detail->approved_date = date('Y-m-d H:i:s');
        $resign_detail->approved_leader = Auth::user()->master_karyawan_id;
        $resign_detail->approved_text = $approved_text;
        $resign_detail->approved_percentage = $resign_detail->approved_percentage + $percentage;
        $resign_detail->approved_background = "primary";
        $resign_detail->save();

        $resign = HcResign::find($resign_detail->resign_id);
        $resign->status = 1;
        $resign->approved_date = date('Y-m-d H:i:s');
        $resign->approved_leader = Auth::user()->master_karyawan_id;
        $resign->approved_text = $approved_text;
        $resign->approved_percentage = $resign->approved_percentage + $percentage;
        $resign->approved_background = "primary";
        $resign->save();

        // activity_log($resign_detail, "resign_detail", "approved");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function resignDisapproved($id)
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "L") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $resign_detail = ResignDetail::find($id);
        $resign_detail->status = 1;
        $resign_detail->confirm = 2;
        $resign_detail->approved_date = date('Y-m-d H:i:s');
        $resign_detail->approved_leader = Auth::user()->master_karyawan_id;
        $resign_detail->approved_text = $approved_text;
        $resign_detail->approved_percentage = 100;
        $resign_detail->approved_background = "danger";
        $resign_detail->save();

        $resign = HcResign::find($resign_detail->resign_id);
        $resign->status = 2;
        $resign->approved_date = date('Y-m-d H:i:s');
        $resign->approved_leader = Auth::user()->master_karyawan_id;
        $resign->approved_text = $approved_text;
        $resign->approved_percentage = 100;
        $resign->approved_background = "danger";
        $resign->save();

        // activity_log($resign_detail, "resign_detail", "disapproved");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function paklaring($id)
    {
        $karyawan = MasterKaryawan::find($id);

        $kontrak_awal = HcKontrak::where('karyawan_id', $id)->first();
        if ($kontrak_awal) {
            $awal = $kontrak_awal->mulai_kontrak;
        } else {
            $awal = "kosong";
        }

        $kontrak_akhir = HcKontrak::where('karyawan_id', $id)->orderBy('id', 'desc')->first();
        if ($kontrak_akhir) {
            $akhir = $kontrak_akhir->akhir_kontrak;
        } else {
            $akhir = "kosong";
        }

        return view('pages.resign.paklaring', [
            'karyawan' => $karyawan,
            'kontrak_awal' => $awal,
            'kontrak_akhir' => $akhir
        ]);
    }
}
