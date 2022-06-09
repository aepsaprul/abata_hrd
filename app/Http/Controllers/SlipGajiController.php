<?php

namespace App\Http\Controllers;

use App\Exports\TemplateView;
use App\Imports\SlipGajiImport;
use App\Models\HcSlipGaji;
use App\Models\HcSlipGajiDetail;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

        $slip = new HcSlipGaji;
        $slip->tahun = $request->tahun;
        $slip->bulan = $request->bulan;
        $slip->periode = $request->periode;
        $slip->berkas = $nama_file;
        $slip->save();

		// upload ke folder file_siswa di dalam folder public
		$file->move(public_path('/file/slip_gaji/'),$nama_file);

		// import data
		Excel::import(new SlipGajiImport, public_path('/file/slip_gaji/'.$nama_file));

		// alihkan halaman kembali
		return redirect()->route('slip_gaji.index');
    }

    public function edit($id)
    {
        $slip = HcSlipGaji::find($id);

        return response()->json([
            'slip' => $slip
        ]);
    }

    public function update(Request $request)
    {
        $slip = HcSlipGaji::find($request->edit_id);
        $slip->tahun = $request->edit_tahun;
        $slip->bulan = $request->edit_bulan;
        $slip->periode = $request->edit_periode;
        $slip->save();
    }

    public function delete($id)
    {
        $slip = HcSlipGaji::find($id);

        $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $slip->id);
        $slip_detail->delete();

        $slip->delete();

        return redirect()->route('slip_gaji.index');
    }

    public function cetakPdf($id)
    {
        $slip = HcSlipGaji::find($id);
        $slip_detail = HcSlipGajiDetail::select(DB::raw('sum(gaji_pokok) as gaji_pokok'),
                DB::raw('sum(tunj_jabatan) as tunj_jabatan'),
                DB::raw('sum(tunj_makan) as tunj_makan'),
                DB::raw('sum(tunj_transport) as tunj_transport'),
                DB::raw('sum(tunj_komunikasi) as tunj_komunikasi'),
                DB::raw('sum(tunj_kost) as tunj_kost'),
                DB::raw('sum(tunj_khusus) as tunj_khusus'),
                DB::raw('sum(uang_lembur) as uang_lembur'),
                DB::raw('sum(bonus_cabang) as bonus_cabang'),
                DB::raw('sum(bonus_project) as bonus_project'),
                DB::raw('sum(bonus_desain) as bonus_desain'),
                DB::raw('sum(bonus_kehadiran) as bonus_kehadiran'),
                DB::raw('sum(lain_lain) as lain_lain'),
                DB::raw('sum(hutang_karyawan) as hutang_karyawan'),
                DB::raw('sum(retur_produksi) as retur_produksi'),
                DB::raw('sum(premi_bpjs_kes) as premi_bpjs_kes'),
                DB::raw('sum(premi_bpjs_tk) as premi_bpjs_tk'),
                DB::raw('sum(pot_alpha_ijin) as pot_alpha_ijin'),
                DB::raw('sum(pot_abata_peduli) as pot_abata_peduli'),
                DB::raw('sum(pph21) as pph21'),
                DB::raw('sum(pot_lain) as pot_lain'),
                'master_karyawans.master_cabang_id')
            ->join('master_karyawans', 'hc_slip_gaji_details.karyawan_id', '=', 'master_karyawans.id')
            ->where('slip_gaji_id', $id)
            ->groupBy('master_karyawans.master_cabang_id')
            ->get();

        $cabang = MasterCabang::get();
        // $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', Auth::user()->master_karyawan_id)->first();

        $pdf = PDF::loadView('pages.slip_gaji.detail', ['slip' => $slip, 'slip_detail' => $slip_detail, 'cabangs' => $cabang]);
        return $pdf->stream();
    }
}
