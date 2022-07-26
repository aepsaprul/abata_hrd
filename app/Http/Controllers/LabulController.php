<?php

namespace App\Http\Controllers;

use App\Models\LabulInstansi;
use App\Models\LabulReseller;
use App\Models\MasterCabang;
use Illuminate\Http\Request;

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

    public function inputDataMember()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputReseller()
    {
        $cabang = MasterCabang::get();
        $reseller = LabulReseller::get();

        return response()->json([
            'cabangs' => $cabang,
            'resellers' => $reseller
        ]);
    }

    public function inputDataReseller()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputInstansi()
    {
        $cabang = MasterCabang::get();
        $instansi = LabulInstansi::get();

        return response()->json([
            'cabangs' => $cabang,
            'instansis' => $instansi
        ]);
    }

    public function inputSurveyKompetitor()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputKomplain()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
        ]);
    }

    public function inputDataInstansi()
    {
        $cabang = MasterCabang::get();

        return response()->json([
            'cabangs' => $cabang
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
