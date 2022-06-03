<?php

namespace App\Http\Controllers;

use App\Exports\TemplateView;
use App\Imports\SlipGajiImport;
use App\Models\HcSlipGaji;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SlipGajiController extends Controller
{
    public function index()
    {
        $slip = HcSlipGaji::get();

        return view('pages.slip_gaji.index', ['slips' => $slip]);
    }

    public function template()
    {
        $karyawan = MasterKaryawan::where('status', 'Aktif')->whereNull('deleted_at')->get();

        return view('pages.slip_gaji.template', ['karyawans' => $karyawan]);
    }

    public function export()
    {
        return Excel::download(new TemplateView, 'template.xlsx');
    }

    public function import(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move(public_path('/file/slip_gaji/'),$nama_file);

		// import data
		Excel::import(new SlipGajiImport, public_path('/file/slip_gaji/'.$nama_file));

		// alihkan halaman kembali
		return redirect()->route('slip_gaji.index');
    }
}
