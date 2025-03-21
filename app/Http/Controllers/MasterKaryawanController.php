<?php

namespace App\Http\Controllers;

use App\Exports\RekapKaryawanExport;
use App\Models\HcKeluargaSebelumMenikah;
use App\Models\HcKeluargaSetelahMenikah;
use App\Models\HcKerabatDarurat;
use App\Models\HcKontrak;
use App\Models\HcMedsos;
use App\Models\HcPendidikan;
use App\Models\HistoriJabatan;
use App\Models\MasterCabang;
use App\Models\MasterDivisi;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use App\Models\MasterRole;
use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MasterKaryawanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $karyawans = MasterKaryawan::with('masterJabatan')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
    $cabangs = MasterCabang::orderBy('grup', 'desc')->get();

    return view('pages.karyawan.index', [
      'karyawans' => $karyawans,
      'cabangs' => $cabangs
    ]);
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
    $divisis = MasterDivisi::get();
    $role = MasterRole::get();

    return response()->json([
      'cabangs' => $cabangs,
      'jabatans' => $jabatans,
      'divisis' => $divisis,
      'roles' => $role
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $messages = [
          'nik.required' => 'NIK harus diisi',
          'nama_lengkap.required' => 'Nama lengkap harus diisi',
          'nama_panggilan.required' => 'Nama panggilan harus diisi',
          'email.required' => 'Email harus diisi',
          'email.email' => 'Email harus diisi dengan tipe email',
          'email.unique' => 'Email sudah dipakai',
          'email.max' => 'Email diisi makasimal 50 karakter',
          'telepon.required' => 'Telepon harus diisi',
          'telepon.unique' => 'Telepon sudah terpakai',
          'telepon.max' => 'Telepon diisi maksimal 15 karakter',
          'nomor_ktp.required' => 'Nomor KTP harus diisi',
          'nomor_ktp.unique' => 'Nomor KTP sudah terpakai',
          'nomor_ktp.max' => 'Nomor KTP diisi maksimal 16 karakter',
          'status_perkawinan.required' => 'Status perkawinan harus diisi',
          'master_cabang_id.required' => 'Cabang harus diisi',
          'master_jabatan_id.required' => 'Jabatan harus diisi',
          'master_divisi_id.required' => 'Divisi harus diisi',
          'role.required' => 'Role harus diisi',
          'agama.required' => 'Agama harus diisi',
          'agama.max' => 'Agama diisi maksimal 10 karakter',
          'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
          'jenis_kelamin.max' => 'Jenis kelamin diisi maksimal 1 karakter',
          'tempat_lahir.required' => 'Tempat lahir harus diisi',
          'tempat_lahir.max' => 'Tempat lahir diisi maksimal 30 karakter',
          'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
          'tanggal_lahir.date' => 'Tanggal lahir harus diisi dengan tipe date',
          'alamat_asal.required' => 'Alamat asal harus diisi',
          'alamat_domisili.required' => 'Alamat domisili harus diisi',
          'foto.required' => 'foto harus diisi',
          'foto.image' => 'foto harus diisi dengan tipe gambar',
          'foto.mimes' => 'foto harus diisi dengan format jpg/jpeg/png',
          'foto.max' => 'foto maksimal 2 Mb'
      ];

      $validator = Validator::make($request->all(), [
          'nik' => 'required',
          'nama_lengkap' => 'required',
          'nama_panggilan' => 'required',
          'email' => 'required|email|unique:master_karyawans|max:50',
          'telepon' => 'required|unique:master_karyawans|max:15',
          'nomor_ktp' => 'required|unique:master_karyawans|max:16',
          'status_perkawinan' => 'required',
          'master_cabang_id' => 'required',
          'master_jabatan_id' => 'required',
          'master_divisi_id' => 'required',
          'role' => 'required',
          'agama' => 'required|max:10',
          'jenis_kelamin' => 'required|max:1',
          'tempat_lahir' => 'required|max:30',
          'tanggal_lahir' => 'required|date',
          'alamat_asal' => 'required',
          'alamat_domisili' => 'required',
          'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
      ], $messages);

      if ($validator->fails()) {
          return response()->json([
              'status' => 400,
              'errors' => $validator->errors()
          ]);
      } else {
          $karyawan = new MasterKaryawan;
          $karyawan->nik = $request->nik;
          $karyawan->nama_lengkap = $request->nama_lengkap;
          $karyawan->nama_panggilan = $request->nama_panggilan;
          $karyawan->email = $request->email;
          $karyawan->telepon = $request->telepon;
          $karyawan->nomor_ktp = $request->nomor_ktp;
          $karyawan->status_perkawinan = $request->status_perkawinan;
          $karyawan->jenis_sim = $request->jenis_sim;
          $karyawan->nomor_sim = $request->nomor_sim;
          $karyawan->master_cabang_id = $request->master_cabang_id;
          $karyawan->master_jabatan_id = $request->master_jabatan_id;
          $karyawan->master_divisi_id = $request->master_divisi_id;
          $karyawan->role = $request->role;
          $karyawan->agama = $request->agama;
          $karyawan->jenis_kelamin = $request->jenis_kelamin;
          $karyawan->tempat_lahir = $request->tempat_lahir;
          $karyawan->tanggal_lahir = $request->tanggal_lahir;
          $karyawan->alamat_asal = $request->alamat_asal;
          $karyawan->alamat_domisili = $request->alamat_domisili;
          $karyawan->rekening_nomor = $request->rekening_nomor;
          $karyawan->status = "Aktif";
          $karyawan->created_by = Auth::user()->id;

          if($request->hasFile('foto')) {
              $file = $request->file('foto');
              $extension = $file->getClientOriginalExtension();
              $filename = time() . "." . $extension;
              $file->move(env('APP_URL_IMG') . 'image/', $filename);
              $karyawan->foto = $filename;
          }

          $karyawan->save();

          // user create
          $user = new User;
          $user->name = $request->nama_lengkap;
          $user->email = $request->email;
          $user->password = Hash::make('abataprinting');
          $user->master_karyawan_id = $karyawan->id;
          $user->roles = "guest";
          $user->save();

          // activity_log($karyawan, "karyawan", "created");

          return response()->json([
              'status' => 200,
              'message' => "Data berhasil ditambahkan"
          ]);
      }
  }

  public function show($id)
  {
    $decrypt_id = decrypt($id);

    $karyawan = MasterKaryawan::find($decrypt_id);
    $kontrak = HcKontrak::where('karyawan_id', $decrypt_id)->get();
    $medsos = HcMedsos::where('karyawan_id', $decrypt_id)->get();
    $sebelum_menikah = HcKeluargaSebelumMenikah::where('karyawan_id', $decrypt_id)->get();
    $setelah_menikah = HcKeluargaSetelahMenikah::where('karyawan_id', $decrypt_id)->get();
    $kerabat_darurat = HcKerabatDarurat::where('karyawan_id', $decrypt_id)->get();
    $pendidikan = HcPendidikan::where('karyawan_id', $decrypt_id)->get();

    // source status level karyawan
    $kontrak_pertama = HcKontrak::where('karyawan_id', $decrypt_id)->orderBy('id', 'asc')->first();

    // training
    $karyawanId = $karyawan->id;
    $training = Training::whereHas('dataPeserta', function($q) use ($karyawanId) {
      $q->where('master_karyawan_id', $karyawanId);
    })->get();

    $total_durasi_training = $training->sum(function($q) {
      return $q->durasi;
    });

    // Jika user tidak ditemukan, kembalikan respon error
    if (!$karyawan) {
      return response()->json(['message' => 'User not found'], 404);
    }

    // Ambil modul-modul yang diikuti user melalui training
    $moduls = $karyawan->trainings()
      ->with('moduls')  // Memuat relasi moduls dari training
      ->get()
      ->pluck('moduls') // Mengambil data modul dari setiap training
      ->flatten()       // Menggabungkan modul dari semua training
      ->unique('id');   // Menghilangkan duplikat berdasarkan ID modul

    // histori jabatan
    $historiJabatan = HistoriJabatan::where('master_karyawan_id', $karyawanId)->get();

    return view('pages.karyawan.show', [
      'karyawan' => $karyawan,
      'kontraks' => $kontrak,
      'medsos' => $medsos,
      'sebelum_menikahs' => $sebelum_menikah,
      'setelah_menikahs' => $setelah_menikah,
      'kerabat_darurats' => $kerabat_darurat,
      'pendidikans' => $pendidikan,
      'kontrak_pertama' => $kontrak_pertama,
      'total_durasi_training' => $total_durasi_training,
      'training_moduls' => $moduls,
      'histori_jabatans' => $historiJabatan
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
    $decrypt_id = decrypt($id);

    $karyawan = MasterKaryawan::find($decrypt_id);
    $cabangs = MasterCabang::get();
    $jabatans = MasterJabatan::orderBy('nama_jabatan', 'asc')->get();
    $divisis = MasterDivisi::get();
    $role = MasterRole::get();

    $medsos = HcMedsos::where('karyawan_id', $decrypt_id)->first();
    $keluarga_sebelum_menikah = HcKeluargaSebelumMenikah::where('karyawan_id', $decrypt_id)->get();
    $keluarga_setelah_menikah = HcKeluargaSetelahMenikah::where('karyawan_id', $decrypt_id)->get();
    $kerabat_darurat = HcKerabatDarurat::where('karyawan_id', $decrypt_id)->first();
    $pendidikan = HcPendidikan::where('karyawan_id', $decrypt_id)->first();
    $kontraks = HcKontrak::where('karyawan_id', $decrypt_id)->orderBy('id', 'desc')->get();

    // histori jabatan
    $historiJabatan = HistoriJabatan::where('master_karyawan_id', $karyawan->id)->get();

    return view('pages.karyawan.edit', [
      'karyawan' => $karyawan,
      'cabangs' => $cabangs,
      'jabatans' => $jabatans,
      'divisis' => $divisis,
      'roles' => $role,
      'medsos' => $medsos,
      'keluarga_sebelum_menikahs' => $keluarga_sebelum_menikah,
      'keluarga_setelah_menikahs' => $keluarga_setelah_menikah,
      'kerabat_darurat' => $kerabat_darurat,
      'pendidikan' => $pendidikan,
      'kontraks' => $kontraks,
      'histori_jabatans' => $historiJabatan
    ]);
  }

  public function deleteBtn($id)
  {
    $karyawan = MasterKaryawan::find($id);

    return response()->json([
      'id' => $karyawan->id
    ]);
  }

  public function delete(Request $request)
  {
      $karyawan = MasterKaryawan::find($request->id);

      $karyawan->deleted_by = Auth::user()->master_karyawan_id;
      $karyawan->save();

      $kontrak = HcKontrak::where('karyawan_id', $karyawan->id);
      $kontrak->delete();

      $medsos = HcMedsos::where('karyawan_id', $karyawan->id);
      $medsos->delete();

      $sebelum_menikah = HcKeluargaSebelumMenikah::where('karyawan_id', $karyawan->id);
      $sebelum_menikah->delete();

      $setelah_menikah = HcKeluargaSetelahMenikah::where('karyawan_id', $karyawan->id);
      $setelah_menikah->delete();

      $kerabat_darurat = HcKerabatDarurat::where('karyawan_id', $karyawan->id);
      $kerabat_darurat->delete();

      $pendidikan = HcPendidikan::where('karyawan_id', $karyawan->id);
      $pendidikan->delete();

      $user = User::where('master_karyawan_id', $karyawan->id)->first();
      $user->delete();

      if (file_exists(env('APP_URL_IMG') . 'image/' . $karyawan->foto)) {
          File::delete(env('APP_URL_IMG') . 'image/' . $karyawan->foto);
      }

      $karyawan->delete();

      // activity_log($karyawan, "karyawan", "deleted");

      return response()->json([
          'status' => 'true'
      ]);
  }

  public function ubahStatus(Request $request)
  {
      $karyawan = MasterKaryawan::find($request->id);
      $karyawan->status = $request->status;
      $karyawan->save();

      // activity_log($karyawan, "karyawan", "ubah_status");

      return response()->json([
          'status' => 'true',
          'id' => $karyawan->id,
          'title' => $karyawan->status
      ]);
  }

  public function biodata($id)
  {
    $karyawan = MasterKaryawan::with([
      'masterJabatan',
      'masterCabang',
      'masterDivisi',
      'kontrak' => function ($query) {
        $query->first('mulai_kontrak');
      }
    ])
    ->find($id);

    $cabangs = MasterCabang::get();
    $jabatans = MasterJabatan::get();
    $divisis = MasterDivisi::get();
    $role = MasterRole::get();

    return response()->json([
      'karyawan' => $karyawan,
      'cabangs' => $cabangs,
      'jabatans' => $jabatans,
      'divisis' => $divisis,
      'roles' => $role
    ]);
  }

  public function biodataUpdate(Request $request)
  {
    $messages = [
      'nik.required' => 'NIK harus diisi',
      'nama_lengkap.required' => 'Nama lengkap harus diisi',
      'nama_panggilan.required' => 'Nama panggilan harus diisi',
      'email.required' => 'Email harus diisi',
      'email.email' => 'Email harus diisi dengan tipe email',
      'email.max' => 'Email diisi makasimal 50 karakter',
      'telepon.required' => 'Telepon harus diisi',
      'telepon.max' => 'Telepon diisi maksimal 15 karakter',
      'nomor_ktp.required' => 'Nomor KTP harus diisi',
      'nomor_ktp.max' => 'Nomor KTP diisi maksimal 16 karakter',
      'status_perkawinan.required' => 'Status perkawinan harus diisi',
      'master_cabang_id.required' => 'Cabang harus diisi',
      'master_jabatan_id.required' => 'Jabatan harus diisi',
      'master_divisi_id.required' => 'Divisi harus diisi',
      'role.required' => 'Role harus diisi',
      'agama.required' => 'Agama harus diisi',
      'agama.max' => 'Agama diisi maksimal 10 karakter',
      'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
      'jenis_kelamin.max' => 'Jenis kelamin diisi maksimal 1 karakter',
      'tempat_lahir.required' => 'Tempat lahir harus diisi',
      'tempat_lahir.max' => 'Tempat lahir diisi maksimal 30 karakter',
      'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
      'tanggal_lahir.date' => 'Tanggal lahir harus diisi dengan tipe date',
      'alamat_asal.required' => 'Alamat asal harus diisi',
      'alamat_domisili.required' => 'Alamat domisili harus diisi',
      'foto.image' => 'foto harus diisi dengan tipe gambar',
      'foto.mimes' => 'foto harus diisi dengan format jpg/jpeg/png',
      'foto.max' => 'foto maksimal 2 Mb'
    ];

    $validator = Validator::make($request->all(), [
      'nik' => 'required',
      'nama_lengkap' => 'required',
      'nama_panggilan' => 'required',
      'email' => 'required|email|max:50',
      'telepon' => 'required|max:15',
      'nomor_ktp' => 'required|max:16',
      'status_perkawinan' => 'required',
      'master_cabang_id' => 'required',
      'master_jabatan_id' => 'required',
      'master_divisi_id' => 'required',
      'role' => 'required',
      'agama' => 'required|max:10',
      'jenis_kelamin' => 'required|max:1',
      'tempat_lahir' => 'required|max:30',
      'tanggal_lahir' => 'required|date',
      'alamat_asal' => 'required',
      'alamat_domisili' => 'required',
      'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
    ], $messages);

    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'errors' => $validator->errors()
      ]);
    } else {
      $user = User::where('master_karyawan_id', $request->id)->first();
      if($user) {
        $user->email = $request->email;
        $user->save();
      }

      $karyawan = MasterKaryawan::find($request->id);
      $karyawan->nik = $request->nik;
      $karyawan->nama_lengkap = $request->nama_lengkap;
      $karyawan->nama_panggilan = $request->nama_panggilan;
      $karyawan->email = $request->email;
      $karyawan->telepon = $request->telepon;
      $karyawan->jenis_sim = $request->jenis_sim;
      $karyawan->nomor_sim = $request->nomor_sim;
      $karyawan->nomor_ktp = $request->nomor_ktp;
      $karyawan->alamat_asal = $request->alamat_asal;
      $karyawan->alamat_domisili = $request->alamat_domisili;
      $karyawan->tempat_lahir = $request->tempat_lahir;
      $karyawan->tanggal_lahir = $request->tanggal_lahir;
      $karyawan->jenis_kelamin = $request->jenis_kelamin;
      $karyawan->status_perkawinan = $request->status_perkawinan;
      $karyawan->agama = $request->agama;
      $karyawan->master_cabang_id = $request->master_cabang_id;

      $karyawan->master_jabatan_id = $request->master_jabatan_id;
      // jika jabatan berubah
      if ($karyawan->isDirty('master_jabatan_id')) {
        $karyawan->master_jabatan_id = $request->master_jabatan_id;

        $historiJabatan = new HistoriJabatan;
        $historiJabatan->master_karyawan_id = $karyawan->id;
        $historiJabatan->master_jabatan_id = $request->master_jabatan_id;
        $historiJabatan->tanggal = date('Y-m-d H:i:s');
        $historiJabatan->save();
      }

      $karyawan->master_divisi_id = $request->master_divisi_id;
      $karyawan->role = $request->role;
      $karyawan->rekening_nomor = $request->rekening_nomor;
      $karyawan->total_cuti = $request->total_cuti;

      if($request->hasFile('foto')) {
        if (file_exists(env('APP_URL_IMG') . 'image/' . $karyawan->foto)) {
          File::delete(env('APP_URL_IMG') . 'image/' . $karyawan->foto);
        }
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move(env('APP_URL_IMG') . 'image/', $filename);
        $karyawan->foto = $filename;
      }

      $karyawan->save();

      return response()->json([
        'status' => 'Data berhasil diperbaharui'
      ]);
    }
  }

  public function kontrak($id)
  {
      $kontrak = HcKontrak::where('karyawan_id', $id)->orderBy('id', 'desc')->get();

      return response()->json([
          'kontraks' => $kontrak
      ]);
  }

  public function kontrakStore(Request $request)
  {
      $kontrak = new HcKontrak;
      $kontrak->karyawan_id = $request->id;
      $kontrak->mulai_kontrak = $request->mulai_kontrak;
      $kontrak->akhir_kontrak = $request->akhir_kontrak;
      $kontrak->lama_kontrak = $request->lama_kontrak;
      $kontrak->save();

      $kontraks = HcKontrak::where('karyawan_id', $request->id)->get();

      // activity_log($kontrak, "karyawan_kontrak", "created_kontrak");

      return response()->json([
          'status' => 'Kontrak berhasil di tambahkan',
          'kontraks' => $kontraks
      ]);
  }

  public function kontrakDelete($id)
  {
      $kontrak = HcKontrak::find($id);
      $kontrak->delete();

      $kontraks = HcKontrak::where('karyawan_id', $kontrak->karyawan_id)->get();

      // activity_log($kontrak, "karyawan_kontrak", "deleted_kontrak");

      return response()->json([
          'status' => 'Data kontrak berhasil dihapus',
          'kontraks' => $kontraks
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

      // activity_log($medsos, "karyawan_medsos", "created_medsos");

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

      // activity_log($medsos, "karyawan_medsos", "deleted_medsos");

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

      // activity_log($sebelumMenikah, "karyawan_sebelum_menikah", "created_sebelum_menikah");

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

      // activity_log($sebelumMenikah, "karyawan_sebelum_menikah", "deleted_sebelum_menikah");

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

      // activity_log($setelahMenikah, "karyawan_setelah_menikah", "created_setelah_menikah");

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

      // activity_log($setelahMenikah, "karyawan_setelah_menikah", "deleted_setelah_menikah");

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

      // activity_log($kerabatDarurat, "karyawan_kerabat_darurat", "created_kerabat_darurat");

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

      // activity_log($kerabatDarurat, "karyawan_kerabat_darurat", "deleted_kerabat_darurat");

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

      // activity_log($pendidikan, "karyawan_pendidikan", "created_pendidikan");

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

      // activity_log($pendidikan, "karyawan_pendidikan", "deleted_pendidikan");

      return response()->json([
          'status' => 'Data pendidikan berhasil dihapus',
          'pendidikans' => $pendidikans
      ]);
  }

  public function resetPasswordBtn($id)
  {
    $karyawan = MasterKaryawan::find($id);

    return response()->json([
      'karyawan' => $karyawan
    ]);
  }

  public function resetPassword(Request $request)
  {
    $user = User::where('master_karyawan_id', $request->id)->first();
    $user->password = Hash::make('abataprinting');
    $user->save();

    return response()->json([
      'status' => 200
    ]);
  }

  public function historiJabatanStore(Request $request)
  {
    $historiJabatan = new HistoriJabatan;
    $historiJabatan->master_karyawan_id = $request->master_karyawan_id;
    $historiJabatan->master_jabatan_id = $request->master_jabatan_id;
    $historiJabatan->tanggal = $request->tanggal;
    $historiJabatan->save();

    return response()->json([
      'data' => 'sukses'
    ]);
  }

  public function historiJabatanDelete($id)
  {
    $historiJabatan = HistoriJabatan::find($id);
    $historiJabatan->delete();

    return response()->json([
      'data' => 'sukses'
    ]);
  }

  public function filter(Request $request)
  {
    $cabang = $request->input('filter_cabang', []);
    $status = $request->input('filter_status', []);
    $filter_bulan = $request->input('bulan');

    $query = MasterKaryawan::with([
      'masterJabatan', 
      'masterCabang', 
      'masterDivisi',
      'kontrakTerakhir' => function ($query) {
        $query->latest('akhir_kontrak');
      }
    ]);

    if (!empty($cabang)) {
      $query->whereIn('master_cabang_id', $cabang);
    }

    if (!empty($status)) {
      $query->whereIn('status', $status);
    }

    $karyawans = $query->get();

    // Filter lama kontrak berdasarkan bulan
    if ($filter_bulan) {
      $karyawans = $karyawans->filter(function ($karyawan) use ($filter_bulan) {
          if ($karyawan->kontrakTerakhir) {
              $lama_kontrak = Carbon::parse($karyawan->kontrakTerakhir->mulai_kontrak)->diffInMonths(Carbon::parse($karyawan->kontrakTerakhir->akhir_kontrak));
              return $lama_kontrak == $filter_bulan;
          }
          return false;
      });
  }

    return response()->json([
      'karyawans' => $karyawans,
      'cabang' => $cabang,
      'status' => $status
    ]);
  }

  public function ubahBpjsTk(Request $request)
  {
    $karyawan = MasterKaryawan::find($request->id);
    $karyawan->bpjs_tk = $request->bpjs_tk;
    $karyawan->save();

    return response()->json([
      'status' => 'true',
      'id' => $karyawan->id,
      'title' => $karyawan->bpjs_tk
    ]);
  }

  public function ubahBpjsKes(Request $request)
  {
    $karyawan = MasterKaryawan::find($request->id);
    $karyawan->bpjs_kes = $request->bpjs_kes;
    $karyawan->save();

    return response()->json([
      'status' => 'true',
      'id' => $karyawan->id,
      'title' => $karyawan->bpjs_kes
    ]);
  }

  public function rekapShowAll()
  {
    return 'a';
  }
}
