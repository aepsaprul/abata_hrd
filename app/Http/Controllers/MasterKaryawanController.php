<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HcKontrak;
use App\Models\HcPendidikan;
use App\Models\MasterCabang;
use Illuminate\Http\Request;
use App\Models\HcMediaSosial;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\HcKerabatDarurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\HcKeluargaSebelumMenikah;
use App\Models\HcKeluargaSetelahMenikah;

class MasterKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = MasterKaryawan::with('masterJabatan')->orderBy('id', 'desc')->get();

        return view('karyawan.index', ['karyawans' => $karyawans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();

        return view('karyawan.create', ['cabangs' => $cabangs, 'jabatans' => $jabatans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $email = $request->email;

        $karyawans = new MasterKaryawan;
        $karyawans->nama_lengkap = $request->nama_lengkap;
        $karyawans->nama_panggilan = $request->nama_panggilan;
        $karyawans->email = $request->email;
        $karyawans->telepon = $request->telepon;
        $karyawans->nomor_ktp = $request->nomor_ktp;
        $karyawans->nomor_sim = $request->nomor_sim;
        $karyawans->master_cabang_id = $request->master_cabang_id;
        $karyawans->master_jabatan_id = $request->master_jabatan_id;
        $karyawans->agama = $request->agama;
        $karyawans->jenis_kelamin = $request->jenis_kelamin;
        $karyawans->tempat_lahir = $request->tempat_lahir;
        $karyawans->tanggal_lahir = $request->tanggal_lahir;
        $karyawans->alamat_asal = $request->alamat_ktp;
        $karyawans->alamat_domisili = $request->alamat_sekarang;
        $karyawans->status_perkawinan = $request->status_perkawinan;
        $karyawans->total_cuti = $request->total_cuti;
        $karyawans->created_by = Auth::user()->id;

        if($request->file('foto')) {
            $file = $request->file('foto')->store('foto', 'public');
            $karyawans->foto = $file;
        }

        $karyawans->save();

        $kontraks = new HcKontrak;
        $kontraks->email = $request->email;
        $kontraks->mulai_kontrak = $request->mulai_kontrak;
        $kontraks->akhir_kontrak = $request->akhir_kontrak;
        $kontraks->lama_kontrak = $request->lama_kontrak;
        $kontraks->save();

        $media_sosial = new HcMediaSosial;
        $media_sosial->email = $request->email;
        $media_sosial->facebook = $request->facebook;
        $media_sosial->instagram = $request->instagram;
        $media_sosial->linkedin = $request->linkedin;
        $media_sosial->youtube = $request->youtube;
        $media_sosial->save();

        foreach ($request->keluarga_sebelum_menikah_hubungan as $key => $value) {
            $keluarga_sebelum_menikah = new HcKeluargaSebelumMenikah;
            $keluarga_sebelum_menikah->email = $email;
            $keluarga_sebelum_menikah->hubungan = $value;
            $keluarga_sebelum_menikah->nama = $request->keluarga_sebelum_menikah_nama[$key];
            $keluarga_sebelum_menikah->usia = $request->keluarga_sebelum_menikah_usia[$key];
            $keluarga_sebelum_menikah->jenis_kelamin = $request->keluarga_sebelum_menikah_jenis_kelamin[$key];
            $keluarga_sebelum_menikah->pendidikan_terakhir = $request->keluarga_sebelum_menikah_pendidikan_terakhir[$key];
            $keluarga_sebelum_menikah->pekerjaan_terakhir = $request->keluarga_sebelum_menikah_pekerjaan_terakhir[$key];
            $keluarga_sebelum_menikah->save();
        }

        if (!empty($request->keluarga_setelah_menikah_hubungan)) {
            # code...
            foreach ($request->keluarga_setelah_menikah_hubungan as $key => $value) {
                $keluarga_setelah_menikah = new HcKeluargaSetelahMenikah;
                $keluarga_setelah_menikah->email = $email;
                $keluarga_setelah_menikah->hubungan = $value;
                $keluarga_setelah_menikah->nama = $request->keluarga_setelah_menikah_nama[$key];
                $keluarga_setelah_menikah->tempat_lahir = $request->keluarga_setelah_menikah_tempat_lahir[$key];
                $keluarga_setelah_menikah->tanggal_lahir = $request->keluarga_setelah_menikah_tanggal_lahir[$key];
                $keluarga_setelah_menikah->pekerjaan_terakhir = $request->keluarga_setelah_menikah_pekerjaan_terakhir[$key];
                $keluarga_setelah_menikah->save();
            }
        }

        if (!empty($request->kerabat_hubungan)) {
            # code...
            foreach ($request->kerabat_hubungan as $key => $value) {
                $kerabat = new HcKerabatDarurat;
                $kerabat->email = $request->email;
                $kerabat->hubungan = $value;
                $kerabat->nama = $request->kerabat_nama[$key];
                $kerabat->jenis_kelamin = $request->kerabat_jenis_kelamin[$key];
                $kerabat->telepon = $request->kerabat_telepon[$key];
                $kerabat->alamat = $request->kerabat_alamat[$key];
                $kerabat->save();
            }
        }

        $pendidikan = new HcPendidikan;
        $pendidikan->email = $request->email;
        $pendidikan->tingkat = $request->pendidikan_tingkat;
        $pendidikan->nama = $request->pendidikan_nama_gedung;
        $pendidikan->kota = $request->pendidikan_kota;
        $pendidikan->jurusan = $request->pendidikan_jurusan;
        $pendidikan->tahun_masuk = $request->pendidikan_tahun_masuk;
        $pendidikan->tahun_lulus = $request->pendidikan_tahun_lulus;
        $pendidikan->save();

        $user = new User;
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = \Hash::make('abataprinting');
        $user->master_karyawan_id = $karyawans->id;
        $user->roles = "guest";

        if($request->file('foto')) {
            $file = $request->file('foto')->store('foto', 'public');
            $user->foto = $file;
        }

        $user->save();

        return redirect()->route('karyawan.create')->with('status', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = MasterKaryawan::find($id);
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();

        $email = $karyawan->email;
        $medsos = HcMediaSosial::where('email', $email)->first();
        $keluarga_sebelum_menikah = HcKeluargaSebelumMenikah::where('email', $email)->get();
        $keluarga_setelah_menikah = HcKeluargaSetelahMenikah::where('email', $email)->get();
        $kerabat_dihubungi = HcKerabatDarurat::where('email', $email)->first();
        $pendidikan = HcPendidikan::where('email', $email)->first();
        $kontraks = HcKontrak::where('email', $email)->get();

        return view('karyawan.detail', [
            'karyawan' => $karyawan,
            'cabangs' => $cabangs,
            'jabatans' => $jabatans,
            'medsos' => $medsos,
            'keluarga_sebelum_menikahs' => $keluarga_sebelum_menikah,
            'keluarga_setelah_menikahs' => $keluarga_setelah_menikah,
            'kerabat_hubungi' => $kerabat_dihubungi,
            'pendidikan' => $pendidikan,
            'kontraks' => $kontraks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = MasterKaryawan::find($id);
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();

        $email = $karyawan->email;
        $medsos = HcMediaSosial::where('email', $email)->first();
        $keluarga_sebelum_menikah = HcKeluargaSebelumMenikah::where('email', $email)->get();
        $keluarga_setelah_menikah = HcKeluargaSetelahMenikah::where('email', $email)->get();
        $kerabat_darurat = HcKerabatDarurat::where('email', $email)->first();
        $pendidikan = HcPendidikan::where('email', $email)->first();
        $kontraks = HcKontrak::where('email', $email)->orderBy('id', 'desc')->get();

        return view('karyawan.edit', [
            'karyawan' => $karyawan,
            'cabangs' => $cabangs,
            'jabatans' => $jabatans,
            'medsos' => $medsos,
            'keluarga_sebelum_menikahs' => $keluarga_sebelum_menikah,
            'keluarga_setelah_menikahs' => $keluarga_setelah_menikah,
            'kerabat_darurat' => $kerabat_darurat,
            'pendidikan' => $pendidikan,
            'kontraks' => $kontraks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $karyawan = MasterKaryawan::find($id);
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->nama_panggilan = $request->nama_panggilan;
        $karyawan->email = $request->email;
        $karyawan->telepon = $request->telepon;
        $karyawan->master_cabang_id = $request->master_cabang_id;
        $karyawan->master_jabatan_id = $request->master_jabatan_id;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->nomor_ktp = $request->nomor_ktp;
        $karyawan->nomor_sim = $request->nomor_sim;
        $karyawan->agama = $request->agama;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->alamat_asal = $request->alamat_ktp;
        $karyawan->alamat_domisili = $request->alamat_sekarang;
        $karyawan->status_perkawinan = $request->status_perkawinan;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;
        $karyawan->tanggal_keluar = $request->tanggal_keluar;
        $karyawan->alasan = $request->alasan;
        $karyawan->tanggal_pengambilan_ijazah = $request->tanggal_pengambilan_ijazah;
        $karyawan->status = $request->status;
        $karyawan->updated_by = Auth::user()->id;

        if($request->file('foto')) {
            if($karyawan->foto && file_exists(storage_path('app/public/' . $karyawan->foto))) {
                \Storage::delete('public/' . $karyawan->foto);
            }
            $file = $request->file('foto')->store('avatar', 'public');
            $karyawan->foto = $file;
        }

        $karyawan->save();

        $user = User::where('master_karyawan_id', $id)->first();
        $user->name = $request->nama_panggilan;
        $user->email = $request->email;
        $user->save();

        // $kontraks = HcKontrak::where('email', $karyawan->email)->first();
        // $kontraks->email = $request->email;
        // $kontraks->mulai_kontrak = $request->mulai_kontrak;
        // $kontraks->akhir_kontrak = $request->akhir_kontrak;
        // $kontraks->lama_kontrak = $request->lama_kontrak;
        // $kontraks->save();

        $media_sosial = HcMediaSosial::where('email', $karyawan->email)->first();
        $media_sosial->email = $request->email;
        $media_sosial->facebook = $request->facebook;
        $media_sosial->instagram = $request->instagram;
        $media_sosial->linkedin = $request->linkedin;
        $media_sosial->youtube = $request->youtube;
        $media_sosial->save();

        $keluarga_sebelum_menikah_hapus = HcKeluargaSebelumMenikah::where('email', $karyawan->email);
        $keluarga_sebelum_menikah_hapus->delete();

        foreach ($request->keluarga_sebelum_menikah_hubungan as $key => $value) {
            $keluarga_sebelum_menikah = new HcKeluargaSebelumMenikah;
            $keluarga_sebelum_menikah->email = $request->email;
            $keluarga_sebelum_menikah->hubungan = $value;
            $keluarga_sebelum_menikah->nama = $request->keluarga_sebelum_menikah_nama[$key];
            $keluarga_sebelum_menikah->usia = $request->keluarga_sebelum_menikah_usia[$key];
            $keluarga_sebelum_menikah->jenis_kelamin = $request->keluarga_sebelum_menikah_jenis_kelamin[$key];
            $keluarga_sebelum_menikah->pendidikan_terakhir = $request->keluarga_sebelum_menikah_pendidikan_terakhir[$key];
            $keluarga_sebelum_menikah->pekerjaan_terakhir = $request->keluarga_sebelum_menikah_pekerjaan_terakhir[$key];
            $keluarga_sebelum_menikah->save();
        }

        if (!empty($request->keluarga_setelah_menikah_hubungan)) {
            # code...
            $keluarga_setelah_menikah_hapus = HcKeluargaSetelahMenikah::where('email', $karyawan->email);
            $keluarga_setelah_menikah_hapus->delete();

            foreach ($request->keluarga_setelah_menikah_hubungan as $key => $value) {
                $keluarga_setelah_menikah = new HcKeluargaSetelahMenikah;
                $keluarga_setelah_menikah->email = $request->email;
                $keluarga_setelah_menikah->hubungan = $value;
                $keluarga_setelah_menikah->nama = $request->keluarga_setelah_menikah_nama[$key];
                $keluarga_setelah_menikah->tempat_lahir = $request->keluarga_setelah_menikah_tempat_lahir[$key];
                $keluarga_setelah_menikah->tanggal_lahir = $request->keluarga_setelah_menikah_tanggal_lahir[$key];
                $keluarga_setelah_menikah->pekerjaan_terakhir = $request->keluarga_setelah_menikah_pekerjaan_terakhir[$key];
                $keluarga_setelah_menikah->save();
            }
        }

        if (!empty($request->kerabat_hubungan)) {
            # code...
            $kerabat_hapus = HcKerabatDarurat::where('email', $karyawan->email);
            $kerabat_hapus->delete();

            foreach ($request->kerabat_hubungan as $key => $value) {
                $kerabat = new HcKerabatDarurat;
                $kerabat->email = $request->email;
                $kerabat->hubungan = $value;
                $kerabat->nama = $request->kerabat_nama[$key];
                $kerabat->jenis_kelamin = $request->kerabat_jenis_kelamin[$key];
                $kerabat->telepon = $request->kerabat_telepon[$key];
                $kerabat->alamat = $request->kerabat_alamat[$key];
                $kerabat->save();
            }
        }

        $pendidikan = HcPendidikan::where('email', $karyawan->email)->first();
        $pendidikan->email = $request->email;
        $pendidikan->tingkat = $request->pendidikan_tingkat;
        $pendidikan->nama = $request->pendidikan_gedung;
        $pendidikan->kota = $request->pendidikan_kota;
        $pendidikan->jurusan = $request->pendidikan_jurusan;
        $pendidikan->tahun_masuk = $request->pendidikan_tahun_masuk;
        $pendidikan->tahun_lulus = $request->pendidikan_tahun_lulus;
        $pendidikan->save();

        return redirect()->route('karyawan.index')->with('status', 'Data karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $karyawan = MasterKaryawan::find($id);
        $karyawan->deleted_by = Auth::user()->id;
        $karyawan->save();

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('status', 'Data karyawan berhasil dihapus');
    }

    public function kontrakSimpan(Request $request)
    {
        $kontraks = new HcKontrak;
        $kontraks->email = $request->email;
        $kontraks->mulai_kontrak = $request->mulai_kontrak;
        $kontraks->akhir_kontrak = $request->akhir_kontrak;
        $kontraks->lama_kontrak = $request->lama_kontrak;
        $kontraks->save();

        return response()->json([
            'data' => 'sukses'
        ]);
    }

    public function kontrakEdit(Request $request)
    {
        $kontrak = HcKontrak::where('id', $request->id)->first();

        return response()->json([
            'id_kontrak' => $kontrak->id,
            'email' => $kontrak->email,
            'mulai_kontrak' => $kontrak->mulai_kontrak,
            'akhir_kontrak' => $kontrak->akhir_kontrak,
            'lama_kontrak' => $kontrak->lama_kontrak
        ]);
    }

    public function kontrakUpdate(Request $request)
    {
        $kontrak = HcKontrak::where('id', $request->id)->first();
        $kontrak->email = $request->email;
        $kontrak->mulai_kontrak = $request->mulai_kontrak;
        $kontrak->akhir_kontrak = $request->akhir_kontrak;
        $kontrak->lama_kontrak = $request->lama_kontrak;
        $kontrak->save();

        return response()->json([
            'email' => $request->email,
            'mulai_kontrak' => $request->mulai_kontrak,
            'akhir_kontrak' => $request->akhir_kontrak,
            'lama_kontrak' => $request->lama_kontrak
        ]);
    }

    public function kontrakDelete(Request $request)
    {
        $kontrak = HcKontrak::where('id', $request->id)->first();
        $kontrak->delete();

        return response()->json([
            'data' => 'berhasil hapus'
        ]);
    }
}
