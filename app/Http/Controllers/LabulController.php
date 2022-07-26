<?php

namespace App\Http\Controllers;

use App\Models\LabulDataInstansi;
use App\Models\LabulDataMember;
use App\Models\LabulDataReseller;
use App\Models\LabulInstansi;
use App\Models\LabulKomplain;
use App\Models\LabulReseller;
use App\Models\LabulSurveyKompetitor;
use App\Models\MasterCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabulController extends Controller
{
    public function input()
    {
        return view('pages.labul.input.index');
    }

    public function inputActivityPlan()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    // data member
    public function inputDataMember()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputDataMemberStore(Request $request)
    {
        $data_member = new LabulDataMember;
        $data_member->cabang_id = $request->data_member_cabang_id;
        $data_member->tanggal = $request->data_member_tanggal;
        $data_member->nama_member = $request->data_member_nama_member;
        $data_member->nomor_hp = $request->data_member_nomor_hp;
        $data_member->alamat = $request->data_member_alamat;
        $data_member->karyawan_id = Auth::user()->master_karyawan_id;
        $data_member->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // reseller
    public function inputReseller()
    {
        $cabang = MasterCabang::get();
        $reseller = LabulDataReseller::get();

        return response()->json([
            'cabangs' => $cabang,
            'resellers' => $reseller
        ]);
    }

    public function inputResellerStore(Request $request)
    {
        $reseller = new LabulReseller;
        $reseller->karyawan_id = Auth::user()->master_karyawan_id;
        $reseller->cabang_id = $request->reseller_cabang_id;
        $reseller->tanggal = $request->reseller_tanggal;
        $reseller->reseller_id = $request->reseller_reseller_id;
        $reseller->hasil_kunjungan = $request->reseller_hasil_kunjungan;
        if($request->hasFile('reseller_foto')) {
            $file = $request->file('reseller_foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/file/labul/', $filename);
            $reseller->foto = $filename;
        }
        $reseller->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // data reseller
    public function inputDataReseller()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputDataResellerStore(Request $request)
    {
        $data_reseller = new LabulDataReseller;
        $data_reseller->karyawan_id = Auth::user()->master_karyawan_id;
        $data_reseller->cabang_id = $request->data_reseller_cabang_id;
        $data_reseller->tanggal = $request->data_reseller_tanggal;
        $data_reseller->nama_reseller = $request->data_reseller_nama_reseller;
        $data_reseller->nama_usaha = $request->data_reseller_nama_usaha;
        $data_reseller->nomor_hp = $request->data_reseller_nomor_hp;
        $data_reseller->alamat = $request->data_reseller_alamat;
        $data_reseller->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // instansi
    public function inputInstansi()
    {
        $cabang = MasterCabang::get();
        $instansi = LabulDataInstansi::get();

        return response()->json([
            'cabangs' => $cabang,
            'instansis' => $instansi
        ]);
    }

    public function inputInstansiStore(Request $request)
    {
        $instansi = new LabulInstansi;
        $instansi->karyawan_id = Auth::user()->master_karyawan_id;
        $instansi->cabang_id = $request->instansi_cabang_id;
        $instansi->tanggal = $request->instansi_tanggal;
        $instansi->instansi_id = $request->instansi_instansi_id;
        if($request->hasFile('instansi_foto')) {
            $file = $request->file('instansi_foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/file/labul/', $filename);
            $instansi->foto = $filename;
        }
        $instansi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // survey kompetitor
    public function inputSurveyKompetitor()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputSurveyKompetitorStore(Request $request)
    {
        $survey = new LabulSurveyKompetitor;
        $survey->karyawan_id = Auth::user()->master_karyawan_id;
        $survey->cabang_id = $request->survey_kompetitor_cabang_id;
        $survey->tanggal = $request->survey_kompetitor_tanggal;
        $survey->nama_kompetitor = $request->survey_kompetitor_nama_kompetitor;
        $survey->hasil_survey = $request->survey_kompetitor_hasil_survey;
        $survey->promo_kompetitor = $request->survey_kompetitor_promo_kompetitor;
        if($request->hasFile('survey_kompetitor_foto')) {
            $file = $request->file('survey_kompetitor_foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/file/labul/', $filename);
            $survey->foto = $filename;
        }
        $survey->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // komplain
    public function inputKomplain()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputKomplainStore(Request $request)
    {
        $komplain = new LabulKomplain;
        $komplain->karyawan_id = Auth::user()->master_karyawan_id;
        $komplain->cabang_id = $request->komplain_cabang_id;
        $komplain->tanggal = $request->komplain_tanggal;
        $komplain->nama_customer = $request->komplain_nama_customer;
        $komplain->nomor_hp = $request->komplain_nomor_hp;
        $komplain->kritik_saran = $request->komplain_kritik_saran;
        $komplain->penanganan_awal = $request->komplain_penanganan_awal;
        $komplain->save();
    }

    // data instansi
    public function inputDataInstansi()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputDataInstansiStore(Request $request)
    {
        $data_instansi = new LabulDataInstansi;
        $data_instansi->karyawan_id = Auth::user()->master_karyawan_id;
        $data_instansi->cabang_id = $request->data_instansi_cabang_id;
        $data_instansi->tanggal = $request->data_instansi_tanggal;
        $data_instansi->pic = $request->data_instansi_pic;
        $data_instansi->nama_instansi = $request->data_instansi_nama_instansi;
        $data_instansi->nomor_hp = $request->data_instansi_nomor_hp;
        $data_instansi->alamat = $request->data_instansi_alamat;
        $data_instansi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function inputReqor()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputOmzetCabang()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function result()
    {
        return view('pages.labul.result.index');
    }
}
