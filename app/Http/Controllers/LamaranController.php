<?php

namespace App\Http\Controllers;

use App\Models\HcLamaran;
use App\Models\LokerBiodata;
use App\Models\LokerKerabatDarurat;
use App\Models\LokerLamaran;
use App\Models\LokerMedsos;
use App\Models\LokerOrganisasi;
use App\Models\LokerPendidikan;
use App\Models\LokerPenghargaan;
use App\Models\LokerRiwayatPekerjaan;
use App\Models\LokerSebelumMenikah;
use App\Models\LokerSetelahMenikah;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    public function index()
    {
        $lamaran = LokerLamaran::get();

        return view('pages.lamaran.index', ['lamarans' => $lamaran]);
    }

    public function show($id)
    {
        $biodata = LokerBiodata::where('email', $id)->first();
        $sebelum_menikah = LokerSebelumMenikah::where('email', $id)->get();
        $setelah_menikah = LokerSetelahMenikah::where('email', $id)->get();
        $kerabat_darurat = LokerKerabatDarurat::where('email', $id)->get();
        $medsos = LokerMedsos::where('email', $id)->get();
        $pendidikan = LokerPendidikan::where('email', $id)->get();
        $penghargaan = LokerPenghargaan::where('email', $id)->get();
        $organisasi = LokerOrganisasi::where('email', $id)->get();
        $riwayat_pekerjaan = LokerRiwayatPekerjaan::where('email', $id)->get();

        return view('pages.lamaran.show', [
            'biodata' => $biodata,
            'sebelum_menikah' => $sebelum_menikah,
            'setelah_menikah' => $setelah_menikah,
            'kerabat_darurat' => $kerabat_darurat,
            'medsos' => $medsos,
            'pendidikan' => $pendidikan,
            'penghargaan' => $penghargaan,
            'organisasi' => $organisasi,
            'riwayat_pekerjaan' => $riwayat_pekerjaan
        ]);
    }

    public function delete($id)
    {
        $lamaran = LokerLamaran::find($id);
        $lamaran->delete();

        return redirect()->route('lamaran.index');
    }

    public function rekrutmen($id)
    {

    }

    public function gagalInterview($id)
    {

    }

    public function interview($id)
    {
        $lamaran = LokerLamaran::find($id);
        $lamaran->status = "interview";
        $lamaran->save();

        return redirect()->route('lamaran.index');
    }

    public function gagal($id)
    {
        $lamaran = LokerLamaran::find($id);
        $lamaran->status = "gagal interview";
        $lamaran->save();

        return redirect()->route('lamaran.index');
    }

    public function terima($id)
    {

    }

    public function berkas($id)
    {

    }
}
