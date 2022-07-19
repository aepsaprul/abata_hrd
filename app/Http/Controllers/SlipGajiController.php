<?php

namespace App\Http\Controllers;

use App\Exports\TemplateView;
use App\Imports\SlipGajiImport;
use App\Models\HcKontrak;
use App\Models\HcSlipGaji;
use App\Models\HcSlipGajiDetail;
use App\Models\HcSlipGajiTemplate;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $karyawan = HcSlipGajiTemplate::with('karyawan')->get();

        return view('pages.slip_gaji.template', ['karyawans' => $karyawan]);
    }

    public function updateTemplate()
    {
        $slip = HcSlipGajiTemplate::orderBy('hirarki_cabang', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.slip_gaji.update_template', ['slips' => $slip]);
    }

    public function updateTemplateCreate()
    {
        $karyawan = MasterKaryawan::with('masterCabang')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->doesntHave('slipGaji')
            ->get();

        return response()->json([
            'karyawans' => $karyawan
        ]);
    }

    public function updateTemplateStore(Request $request)
    {
        $karyawan = MasterKaryawan::find($request->karyawan_id);

        $slip_template = new HcSlipGajiTemplate;
        $slip_template->karyawan_id = $request->karyawan_id;

        // 1. ho
        // 2. situmpur
        // 3. dkw
        // 4. hr
        // 5. purbalingga
        // 6. cilacap
        // 7. wahana
        // 8. adaya
        // 9. ua
        // 10. makzon
        // 11. bumiayu
        // 12. abasoft
        // 13. abavest

        // diubh ke:

        // 1. wahana
        // 2. situmpur
        // 3. cilacap
        // 4. purbalingga
        // 5. adaya
        // 6. dkw
        // 7. hr
        // 8. ua
        // 9. makzon
        // 10. bumiayu
        // 11. abasoft
        // 12. ho

        if ($karyawan->master_cabang_id == 1) {
            $slip_template->hirarki_cabang = 12;
        } elseif ($karyawan->master_cabang_id == 2) {
            $slip_template->hirarki_cabang = 2;
        } elseif ($karyawan->master_cabang_id == 3) {
            $slip_template->hirarki_cabang = 6;
        } elseif ($karyawan->master_cabang_id == 4) {
            $slip_template->hirarki_cabang = 7;
        } elseif ($karyawan->master_cabang_id == 5) {
            $slip_template->hirarki_cabang = 4;
        } elseif ($karyawan->master_cabang_id == 6) {
            $slip_template->hirarki_cabang = 3;
        } elseif ($karyawan->master_cabang_id == 7) {
            $slip_template->hirarki_cabang = 1;
        } elseif ($karyawan->master_cabang_id == 8) {
            $slip_template->hirarki_cabang = 5;
        } elseif ($karyawan->master_cabang_id == 9) {
            $slip_template->hirarki_cabang = 8;
        } elseif ($karyawan->master_cabang_id == 10) {
            $slip_template->hirarki_cabang = 9;
        } elseif ($karyawan->master_cabang_id == 11) {
            $slip_template->hirarki_cabang = 10;
        } elseif ($karyawan->master_cabang_id == 12) {
            $slip_template->hirarki_cabang = 11;
        } else {
            $slip_template->hirarki_cabang = 12;
        }


        $slip_template->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function updateTemplateDelete(Request $request)
    {
        $slip_template = HcSlipGajiTemplate::where('id', $request->id);
        $slip_template->delete();

        return response()->json([
            'status' => 'true'
        ]);
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
    public function cetakPdfKaryawan($id)
    {
        // return view('pages.slip_gaji_karyawan.detail');

        // return view('pages.slip_gaji_karyawan.detail');

        $slip = HcSlipGaji::find($id);
        // $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', Auth::user()->master_karyawan_id)->first();
        $slip_detail = HcSlipGajiDetail::where('slip_gaji_id', $id)->where('karyawan_id', Auth::user()->master_karyawan_id)->first();

        $kontrak = HcKontrak::where('karyawan_id', Auth::user()->master_karyawan_id)->orderBy('id', 'asc')->first();

        // hitung lama kontrak
        if ($kontrak) {
            # code...
            $mulai_kontrak = new DateTime($kontrak->mulai_kontrak);
            $akhir_kontrak = new DateTime(date('Y-m-d'));
            $selisih = $mulai_kontrak->diff($akhir_kontrak);

            if ($selisih->y > 0) {
                if ($selisih->m > 0) {
                    $lama_kontrak = $selisih->y . " Tahun " . $selisih->m . " Bulan";
                } else {
                    $lama_kontrak = $selisih->y . " Tahun ";
                }
            } else {
                $lama_kontrak = $selisih->m . " Bulan";
            }
        } else {
            $lama_kontrak = null;
        }

        $pdf = PDF::loadView('pages.slip_gaji.detail_slip_karyawan', ['slip' => $slip, 'slip_detail' => $slip_detail, 'kontrak' => $kontrak, 'lama_kontrak' => $lama_kontrak]);
        return $pdf->stream();
    }
}
