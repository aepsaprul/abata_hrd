<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use App\Models\HcCutiTgl;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $cuti = HcCuti::where('master_karyawan_id', Auth::user()->master_karyawan_id)->get();

        return view('pages.pengajuan.cuti.index', ['cutis' => $cuti]);
    }

    public function create()
    {
        $karyawan = MasterKaryawan::with('masterJabatan')->where('id', Auth::user()->master_karyawan_id)->first();
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
                'errors' => $validator->messages()
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
            $cuti->save();

            foreach ($request->cuti_tanggal as $key => $value) {
                $cuti_tgl = new HcCutiTgl;
                $cuti_tgl->hc_cuti_id = $cuti->id;
                $cuti_tgl->tanggal = $value;
                $cuti_tgl->save();
            }


            return response()->json([
                'status' => 200,
                'message' => "Data berhasil ditambahkan"
            ]);
        }
    }
}
