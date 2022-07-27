<?php

namespace App\Http\Controllers;

use App\Models\HcKeluargaSebelumMenikah;
use App\Models\HcKeluargaSetelahMenikah;
use App\Models\HcKerabatDarurat;
use App\Models\HcMedsos;
use App\Models\HcPendidikan;
use App\Models\MasterCabang;
use App\Models\MasterDivisi;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\User;
use App\Notifications\BiodataNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $karyawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);

        return view('pages.profile.index', ['karyawan' => $karyawan]);
    }

    public function biodata($id)
    {
        $karyawan = MasterKaryawan::find($id);
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();
        $divisis = MasterDivisi::get();

        return response()->json([
            'karyawan' => $karyawan,
            'cabangs' => $cabangs,
            'jabatans' => $jabatans,
            'divisis' => $divisis
        ]);
    }

    public function biodataUpdate(Request $request)
    {
        $user = User::where('master_karyawan_id', $request->id)->first();
        if($user) {
            $user->email = $request->email;
            $user->save();
        }

        $karyawan = MasterKaryawan::find($request->id);
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->nama_panggilan = $request->nama_panggilan;
        $karyawan->email = $request->email;
        $karyawan->telepon = $request->telepon;
        $karyawan->jenis_sim = $request->jenis_sim;
        $karyawan->nomor_sim = $request->nomor_sim;
        $karyawan->nomor_ktp = $request->nomor_ktp;
        $karyawan->alamat_asal = $request->alamat_asal;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->status_perkawinan = $request->status_perkawinan;
        $karyawan->agama = $request->agama;

        if($request->hasFile('foto')) {
            if (file_exists("public/image/" . $karyawan->foto)) {
                File::delete("public/image/" . $karyawan->foto);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/image/', $filename);
            $karyawan->foto = $filename;
        }

        $karyawan->save();

        // $user = User::find(1);
        // $masterKaryawan = MasterKaryawan::find(Auth::user()->master_karyawan_id);
        // $user->notify(new BiodataNotification($masterKaryawan));

        // activity_log($karyawan, "karyawan", "updated");

        return response()->json([
            'status' => 'Data berhasil diperbaharui'
        ]);
    }

    public function medsos($id)
    {
        $medsos = HcMedsos::where('karyawan_id', $id)->get();

        return response()->json([
            'medsos' => $medsos
        ]);
    }

    public function medsosStore(Request $request)
    {
        $medsos = new HcMedsos;
        $medsos->karyawan_id = $request->id;
        $medsos->nama_media_sosial = $request->nama_media_sosial;
        $medsos->nama_akun = $request->nama_akun;
        $medsos->save();

        $medsoss = HcMedsos::where('karyawan_id', $medsos->karyawan_id)->get();

        // activity_log($medsos, "karyawan_medsos", "created");

        return response()->json([
            'status' => 'Data media sosial berhasil ditambahkan',
            'medsoss' => $medsoss
        ]);
    }

    public function medsosDelete($id)
    {
        $medsos = HcMedsos::find($id);
        $medsos->delete();

        $medsoss = HcMedsos::where('karyawan_id', $medsos->karyawan_id)->get();

        // activity_log($medsos, "karyawan_medsos", "deleted");

        return response()->json([
            'status' => 'Data media sosial berhasil dihapus',
            'medsoss' => $medsoss
        ]);
    }

    public function sebelumMenikah($id)
    {
        $sebelumMenikah = HcKeluargaSebelumMenikah::where('karyawan_id', $id)->get();

        return response()->json([
            'sebelum_menikahs' => $sebelumMenikah
        ]);
    }

    public function sebelumMenikahStore(Request $request)
    {
        $sebelumMenikah = new HcKeluargaSebelumMenikah;
        $sebelumMenikah->karyawan_id = $request->id;
        $sebelumMenikah->hubungan = $request->hubungan;
        $sebelumMenikah->nama = $request->nama;
        $sebelumMenikah->usia = $request->usia;
        $sebelumMenikah->jenis_kelamin = $request->jenis_kelamin;
        $sebelumMenikah->pendidikan_terakhir = $request->pendidikan;
        $sebelumMenikah->pekerjaan_terakhir = $request->pekerjaan;
        $sebelumMenikah->save();

        $sebelumMenikahs = HcKeluargaSebelumMenikah::where('karyawan_id', $sebelumMenikah->karyawan_id)->get();

        // activity_log($sebelumMenikah, "karyawan_sebelum_menikah", "created");

        return response()->json([
            'status' => 'Data keluarga sebelum menikah berhasil diperbaharui',
            'sebelum_menikahs' => $sebelumMenikahs
        ]);
    }

    public function sebelumMenikahDelete($id)
    {
        $sebelumMenikah = HcKeluargaSebelumMenikah::find($id);
        $sebelumMenikah->delete();

        $sebelumMenikahs = HcKeluargaSebelumMenikah::where('karyawan_id', $sebelumMenikah->karyawan_id)->get();

        // activity_log($sebelumMenikah, "karyawan_sebelum_menikah", "deleted");

        return response()->json([
            'status' => 'Data keluarga sebelum menikah berhasil dihapus',
            'sebelum_menikahs' => $sebelumMenikahs
        ]);
    }

    public function setelahMenikah($id)
    {
        $setelahMenikah = HcKeluargaSetelahMenikah::where('karyawan_id', $id)->get();

        return response()->json([
            'setelah_menikahs' => $setelahMenikah
        ]);
    }

    public function setelahMenikahStore(Request $request)
    {
        $setelahMenikah = new HcKeluargaSetelahMenikah;
        $setelahMenikah->karyawan_id = $request->id;
        $setelahMenikah->hubungan = $request->hubungan;
        $setelahMenikah->nama = $request->nama;
        $setelahMenikah->tempat_lahir = $request->tempat_lahir;
        $setelahMenikah->tanggal_lahir = $request->tanggal_lahir;
        $setelahMenikah->pekerjaan_terakhir = $request->pekerjaan;
        $setelahMenikah->save();

        $setelahMenikahs = HcKeluargaSetelahMenikah::where('karyawan_id', $setelahMenikah->karyawan_id)->get();

        // activity_log($setelahMenikah, "karyawan_setelah_menikah", "created");

        return response()->json([
            'status' => 'Data keluarga setelah menikah berhasil diperbaharui',
            'setelah_menikahs' => $setelahMenikahs
        ]);
    }

    public function setelahMenikahDelete($id)
    {
        $setelahMenikah = HcKeluargaSetelahMenikah::find($id);
        $setelahMenikah->delete();

        $setelahMenikahs = HcKeluargaSetelahMenikah::where('karyawan_id', $setelahMenikah->karyawan_id)->get();

        // activity_log($setelahMenikah, "karyawan_setelah_menikah", "deleted");

        return response()->json([
            'status' => 'Data keluarga setelah menikah berhasil dihapus',
            'setelah_menikahs' => $setelahMenikahs
        ]);
    }

    public function kerabatDarurat($id)
    {
        $kerabatDarurat = HcKerabatDarurat::where('karyawan_id', $id)->get();

        return response()->json([
            'kerabat_darurats' => $kerabatDarurat
        ]);
    }

    public function kerabatDaruratStore(Request $request)
    {
        $kerabatDarurat = new HcKerabatDarurat;
        $kerabatDarurat->karyawan_id = $request->id;
        $kerabatDarurat->hubungan = $request->hubungan;
        $kerabatDarurat->nama = $request->nama;
        $kerabatDarurat->jenis_kelamin = $request->jenis_kelamin;
        $kerabatDarurat->telepon = $request->telepon;
        $kerabatDarurat->alamat = $request->alamat;
        $kerabatDarurat->save();

        $kerabatDarurats = HcKerabatDarurat::where('karyawan_id', $kerabatDarurat->karyawan_id)->get();

        // activity_log($kerabatDarurat, "karyawan_kerabat_darurat", "created");

        return response()->json([
            'status' => 'Data kerabat darurat berhasil diperbaharui',
            'kerabat_darurats' => $kerabatDarurats
        ]);
    }

    public function kerabatDaruratDelete($id)
    {
        $kerabatDarurat = HcKerabatDarurat::find($id);
        $kerabatDarurat->delete();

        $kerabatDarurats = HcKerabatDarurat::where('karyawan_id', $kerabatDarurat->karyawan_id)->get();

        // activity_log($kerabatDarurat, "karyawan_kerabat_darurat", "deleted");

        return response()->json([
            'status' => 'Data kerabat darurat berhasil dihapus',
            'kerabat_darurats' => $kerabatDarurats
        ]);
    }

    public function pendidikan($id)
    {
        $pendidikan = HcPendidikan::where('karyawan_id', $id)->get();

        return response()->json([
            'pendidikans' => $pendidikan
        ]);
    }

    public function pendidikanStore(Request $request)
    {
        $pendidikan = new HcPendidikan;
        $pendidikan->karyawan_id = $request->id;
        $pendidikan->tingkat = $request->tingkat;
        $pendidikan->nama = $request->nama;
        $pendidikan->kota = $request->kota;
        $pendidikan->jurusan = $request->jurusan;
        $pendidikan->tahun_masuk = $request->tahun_masuk;
        $pendidikan->tahun_lulus = $request->tahun_lulus;
        $pendidikan->save();

        $pendidikans = HcPendidikan::where('karyawan_id', $pendidikan->karyawan_id)->get();

        // activity_log($pendidikan, "karyawan_pendidikan", "created");

        return response()->json([
            'status' => 'Data pendidikan berhasil diperbaharui',
            'pendidikans' => $pendidikans
        ]);
    }

    public function pendidikanDelete($id)
    {
        $pendidikan = HcPendidikan::find($id);
        $pendidikan->delete();

        $pendidikans = HcPendidikan::where('karyawan_id', $pendidikan->karyawan_id)->get();

        // activity_log($pendidikan, "karyawan_pendidikan", "deleted");

        return response()->json([
            'status' => 'Data pendidikan berhasil dihapus',
            'pendidikans' => $pendidikans
        ]);
    }
}
