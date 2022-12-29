<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use App\Models\HcKontrak;
use App\Models\HcResign;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan_aktif = MasterKaryawan::where('status', 'aktif')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        $karyawan_kontrak = HcKontrak::with(['karyawan' => function ($query) {
              $query->where('status', 'Aktif');
            }])
            ->where('karyawan_id', '!=', null)
            ->select(DB::raw('max(id) as id'),'karyawan_id', DB::raw('max(mulai_kontrak) as mulai_kontrak'), DB::raw('max(akhir_kontrak) as akhir_kontrak'))
            ->groupBy('karyawan_id')
            ->orderBy('id', 'desc')
            ->get();

        $count_karyawan_aktif = count($karyawan_aktif);

        $karyawan_nonaktif = MasterKaryawan::where('status', 'nonaktif')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $count_karyawan_nonaktif = count($karyawan_nonaktif);

        $cuti = HcCuti::where('approved_percentage', '<', 100)->orderBy('id', 'desc')->get();
        $count_cuti = count($cuti);

        $resign = HcResign::where('approved_percentage', '<', 100)->orderBy('id', 'desc')->get();
        $count_resign = count($resign);

        return view('pages.dashboard.index', [
            'karyawan_aktif' => $karyawan_aktif,
            'count_karyawan_aktif' => $count_karyawan_aktif,
            'karyawan_nonaktif' => $karyawan_nonaktif,
            'count_karyawan_nonaktif' => $count_karyawan_nonaktif,
            'cuti' => $cuti,
            'count_cuti' => $count_cuti,
            'resign' => $resign,
            'count_resign' => $count_resign,
            'karyawan_kontrak' => $karyawan_kontrak
        ]);
    }

    public function show($id)
    {
        $karyawan = MasterKaryawan::find($id);
        $karyawan_kontrak = HcKontrak::where('karyawan_id', $id)->get();

        return response()->json([
            'karyawan' => $karyawan,
            'karyawan_kontraks' => $karyawan_kontrak
        ]);
    }

    public function store(Request $request)
    {
        $karyawan = new HcKontrak;
        $karyawan->karyawan_id = $request->id;
        $karyawan->mulai_kontrak = $request->mulai_kontrak;
        $karyawan->akhir_kontrak = $request->akhir_kontrak;
        $karyawan->lama_kontrak = $request->lama_kontrak;
        $karyawan->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
