<?php

namespace App\Http\Controllers;

use App\Models\HcResign;
use App\Models\HcResignCeklis;
use App\Models\HcResignSurveiCeklis;
use App\Models\HcResignSurveiEssay;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\ResignApprover;
use App\Models\ResignDetail;
use App\Models\User;
use App\Notifications\ResignNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanResignController extends Controller
{
    public function index()
    {
        $resign = HcResign::where('master_karyawan_id', Auth::user()->master_karyawan_id)->get();

        return view('pages.pengajuan.resign.index', ['resigns' => $resign]);
    }

    public function create()
    {
        $nama_karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);
        $karyawans = MasterKaryawan::get();
        $jabatans = MasterJabatan::get();

        return view('pages.pengajuan.resign.create', ['nama_karyawan' => $nama_karyawan,'karyawans' => $karyawans, 'jabatans' => $jabatans]);
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

        $tes = User::whereIn('master_karyawan_id', $a)->get();
        foreach ($tes as $key => $value) {
            # code...
            $value->notify(new ResignNotification($value));
        }

        activity_log($resigns, "resign", "created");

        return redirect()->route('pengajuan_resign.index')->with('status', 'Data berhasil disimpan');
    }
}
