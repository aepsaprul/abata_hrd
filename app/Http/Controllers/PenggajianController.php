<?php

namespace App\Http\Controllers;

use App\Models\HcPenggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = HcPenggajian::with('karyawan')->orderBy('id', 'desc')->get();
        return view('pages.penggajian.index', ['penggajians' => $penggajian]);
    }

    public function store(Request $request)
    {
        if ($request->status == "baru") {
            $status = "Gaji Payroll Bulan " . $request->bulan . " " . $request->tahun;
        } else {
            $status = "Revisi Payroll Bulan " . $request->bulan . " " . $request->tahun;
        }
        $penggajian = new HcPenggajian;
        $penggajian->karyawan_id = Auth::user()->masterKaryawan->id;
        $penggajian->judul = $status;
        $penggajian->tanggal_upload = date('Y-m-d H:i:s');
        $penggajian->status = 1;
        $penggajian->status_bar = "50%";

        $file_name = $request->file('create_file')->getClientOriginalName();
        // $request->file('create_file')->storeAs('file', $file_name);
        $penggajian->file = $file_name;

        $penggajian->save();

        return response()->json([
            'data' => $file_name
        ]);
    }

    public function delete(Request $request)
    {
        $penggajian = HcPenggajian::find($request->id);
        $penggajian->delete();

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }

    public function download(Request $request, $file)
    {
        return response()->download(storage_path('app/file/'. $file));
    }

    public function approve($id)
    {
        $penggajian = HcPenggajian::find($id);
        $penggajian->status = 2;
        $penggajian->save();

        return redirect()->route('penggajian.index');
    }

    public function reject(Request $request)
    {
        $penggajian = HcPenggajian::find($request->id);
        $penggajian->status = 3;
        $penggajian->alasan = $request->alasan;
        $penggajian->save();

        return redirect()->route('penggajian.index');
    }
}
