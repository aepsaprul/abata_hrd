<?php

namespace App\Http\Controllers;

use App\Exports\LabulActivityPlanExport;
use App\Exports\LabulDataInstansiExport;
use App\Exports\LabulDataMemberExport;
use App\Exports\LabulDataResellerExport;
use App\Exports\LabulInstansiExport;
use App\Exports\LabulKomplainExport;
use App\Exports\LabulOmzetExport;
use App\Exports\LabulReqorExport;
use App\Exports\LabulResellerExport;
use App\Exports\LabulSurveyKompetitorExport;
use App\Models\LabulActivityPlan;
use App\Models\LabulActivityPlanJumlah;
use App\Models\LabulActivityPlanRencana;
use App\Models\LabulDataInstansi;
use App\Models\LabulDataMember;
use App\Models\LabulDataReseller;
use App\Models\LabulInstansi;
use App\Models\LabulKomplain;
use App\Models\LabulOmzet;
use App\Models\LabulOmzetSales;
use App\Models\LabulReqor;
use App\Models\LabulReseller;
use App\Models\LabulSurveyKompetitor;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class LabulController extends Controller
{
    public function input()
    {
        return view('pages.labul.input.index');
    }

    // activity plan
    public function inputActivityPlan()
    {
        $cabang = MasterCabang::get();

        if (Auth::user()->masterKaryawan) {
          $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
        } else {
          $cabang_id = 0;
        }

        return response()->json([
            'cabangs' => $cabang,
            'cabang_id' => $cabang_id
        ]);
    }

    public function inputActivityPlanStore(Request $request)
    {
        // labul activity plan
        $activity_plan = new LabulActivityPlan;
        $activity_plan->karyawan_id = Auth::user()->master_karyawan_id;
        $activity_plan->cabang_id = $request->activity_plan_cabang_id;
        $activity_plan->tanggal = $request->activity_plan_tanggal;
        $activity_plan->save();

        // labul jumlah rencana
        if ($request->activity_plan_jumlah_rencana_kunjungan) {
            $activity_plan_jumlah_rencana_kunjungan = new LabulActivityPlanJumlah;
            $activity_plan_jumlah_rencana_kunjungan->activity_plan_id = $activity_plan->id;
            $activity_plan_jumlah_rencana_kunjungan->nama = "Jumlah Rencana Kunjungan";
            $activity_plan_jumlah_rencana_kunjungan->jumlah = $request->activity_plan_jumlah_rencana_kunjungan;
            $activity_plan_jumlah_rencana_kunjungan->save();
        }

        if ($request->activity_plan_jumlah_rencana_salescall) {
            $activity_plan_jumlah_rencana_salescall = new LabulActivityPlanJumlah;
            $activity_plan_jumlah_rencana_salescall->activity_plan_id = $activity_plan->id;
            $activity_plan_jumlah_rencana_salescall->nama = "Jumlah Rencana Salescall";
            $activity_plan_jumlah_rencana_salescall->jumlah = $request->activity_plan_jumlah_rencana_salescall;
            $activity_plan_jumlah_rencana_salescall->save();
        }

        if ($request->activity_plan_jumlah_rencana_sebar_brosur) {
            $activity_plan_jumlah_rencana_sebar_brosur = new LabulActivityPlanJumlah;
            $activity_plan_jumlah_rencana_sebar_brosur->activity_plan_id = $activity_plan->id;
            $activity_plan_jumlah_rencana_sebar_brosur->nama = "Jumlah Rencana Sebar Brosur";
            $activity_plan_jumlah_rencana_sebar_brosur->jumlah = $request->activity_plan_jumlah_rencana_sebar_brosur;
            $activity_plan_jumlah_rencana_sebar_brosur->save();
        }

        if ($request->activity_plan_jumlah_rencana_penawaran) {
            $activity_plan_jumlah_rencana_penawaran = new LabulActivityPlanJumlah;
            $activity_plan_jumlah_rencana_penawaran->activity_plan_id = $activity_plan->id;
            $activity_plan_jumlah_rencana_penawaran->nama = "Jumlah Rencana Penawaran";
            $activity_plan_jumlah_rencana_penawaran->jumlah = $request->activity_plan_jumlah_rencana_penawaran;
            $activity_plan_jumlah_rencana_penawaran->save();
        }

        if ($request->activity_plan_jumlah_penawaran_merchant) {
            $activity_plan_jumlah_penawaran_merchant = new LabulActivityPlanJumlah;
            $activity_plan_jumlah_penawaran_merchant->activity_plan_id = $activity_plan->id;
            $activity_plan_jumlah_penawaran_merchant->nama = "Jumlah Penawaran Merchant";
            $activity_plan_jumlah_penawaran_merchant->jumlah = $request->activity_plan_jumlah_penawaran_merchant;
            $activity_plan_jumlah_penawaran_merchant->save();
        }

        // labul rencana
        if ($request->activity_plan_rencana_kunjungan) {
            foreach ($request->activity_plan_rencana_kunjungan as $key => $value) {
                $activity_plan_rencana_kunjungan = new LabulActivityPlanRencana;
                $activity_plan_rencana_kunjungan->activity_plan_id = $activity_plan->id;
                $activity_plan_rencana_kunjungan->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_kunjungan->id;
                $activity_plan_rencana_kunjungan->nama = $value;
                $activity_plan_rencana_kunjungan->save();
            }
        }

        if ($request->activity_plan_rencana_salescall) {
            foreach ($request->activity_plan_rencana_salescall as $key => $value) {
                $activity_plan_rencana_salescall = new LabulActivityPlanRencana;
                $activity_plan_rencana_salescall->activity_plan_id = $activity_plan->id;
                $activity_plan_rencana_salescall->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_salescall->id;
                $activity_plan_rencana_salescall->nama = $value;
                $activity_plan_rencana_salescall->save();
            }
        }

        if ($request->activity_plan_rencana_sebar_brosur) {
            foreach ($request->activity_plan_rencana_sebar_brosur as $key => $value) {
                $activity_plan_rencana_sebar_brosur = new LabulActivityPlanRencana;
                $activity_plan_rencana_sebar_brosur->activity_plan_id = $activity_plan->id;
                $activity_plan_rencana_sebar_brosur->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_sebar_brosur->id;
                $activity_plan_rencana_sebar_brosur->nama = $value;
                $activity_plan_rencana_sebar_brosur->save();
            }
        }

        if ($request->activity_plan_rencana_penawaran) {
            foreach ($request->activity_plan_rencana_penawaran as $key => $value) {
                $activity_plan_rencana_penawaran = new LabulActivityPlanRencana;
                $activity_plan_rencana_penawaran->activity_plan_id = $activity_plan->id;
                $activity_plan_rencana_penawaran->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_penawaran->id;
                $activity_plan_rencana_penawaran->nama = $value;
                $activity_plan_rencana_penawaran->save();
            }
        }

        if ($request->activity_plan_penawaran_merchant) {
            foreach ($request->activity_plan_penawaran_merchant as $key => $value) {
                $activity_plan_penawaran_merchant = new LabulActivityPlanRencana;
                $activity_plan_penawaran_merchant->activity_plan_id = $activity_plan->id;
                $activity_plan_penawaran_merchant->activity_plan_jumlah_id = $activity_plan_jumlah_penawaran_merchant->id;
                $activity_plan_penawaran_merchant->nama = $value;
                $activity_plan_penawaran_merchant->save();
            }
        }

        return response()->json([
            'status' => $request->all()
        ]);
    }

    // data member
    public function inputDataMember()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputDataMemberStore(Request $request)
    {
        $data_member = new LabulDataMember;
        $data_member->cabang_id = $request->data_member_cabang_id;
        $data_member->tanggal = $request->data_member_tanggal;
        $data_member->nama_member = $request->data_member_nama_member;
        $data_member->nomor_hp = $request->data_member_nomor_hp;
        $data_member->alamat = $request->data_member_alamat;
        $data_member->karyawan_id = Auth::user()->master_karyawan_id;
        $data_member->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // reseller
    public function inputReseller()
    {
      $cabang = MasterCabang::get();
      $reseller = LabulDataReseller::get();
      
      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }
      return response()->json([
        'cabangs' => $cabang,
        'resellers' => $reseller,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputResellerStore(Request $request)
    {
        $reseller = new LabulReseller;
        $reseller->karyawan_id = Auth::user()->master_karyawan_id;
        $reseller->cabang_id = $request->reseller_cabang_id;
        $reseller->tanggal = $request->reseller_tanggal;
        $reseller->reseller_id = $request->reseller_reseller_id;
        $reseller->hasil_kunjungan = $request->reseller_hasil_kunjungan;

        // dev
        // if($request->hasFile('reseller_foto')) {
        //     $file = $request->file('reseller_foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('public/file/labul/', $filename);
        //     $reseller->foto = $filename;
        // }
        // prod
        if($request->hasFile('reseller_foto')) {
          $file = $request->file('reseller_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $reseller->foto = $filename;
        }

        $reseller->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // data reseller
    public function inputDataReseller()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputDataResellerStore(Request $request)
    {
        $data_reseller = new LabulDataReseller;
        $data_reseller->karyawan_id = Auth::user()->master_karyawan_id;
        $data_reseller->cabang_id = $request->data_reseller_cabang_id;
        $data_reseller->tanggal = $request->data_reseller_tanggal;
        $data_reseller->nama_reseller = $request->data_reseller_nama_reseller;
        $data_reseller->nama_usaha = $request->data_reseller_nama_usaha;
        $data_reseller->nomor_hp = $request->data_reseller_nomor_hp;
        $data_reseller->alamat = $request->data_reseller_alamat;
        $data_reseller->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // instansi
    public function inputInstansi()
    {
      $cabang = MasterCabang::get();
      $instansi = LabulDataInstansi::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id,
        'instansis' => $instansi
      ]);
    }

    public function inputInstansiStore(Request $request)
    {
        $instansi = new LabulInstansi;
        $instansi->karyawan_id = Auth::user()->master_karyawan_id;
        $instansi->cabang_id = $request->instansi_cabang_id;
        $instansi->tanggal = $request->instansi_tanggal;
        $instansi->instansi_id = $request->instansi_instansi_id;

        // dev
        // if($request->hasFile('instansi_foto')) {
        //     $file = $request->file('instansi_foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('public/file/labul/', $filename);
        //     $instansi->foto = $filename;
        // }
        // prod
        if($request->hasFile('instansi_foto')) {
          $file = $request->file('instansi_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $instansi->foto = $filename;
        }

        $instansi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // survey kompetitor
    public function inputSurveyKompetitor()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id,
      ]);
    }

    public function inputSurveyKompetitorStore(Request $request)
    {
        $survey = new LabulSurveyKompetitor;
        $survey->karyawan_id = Auth::user()->master_karyawan_id;
        $survey->cabang_id = $request->survey_kompetitor_cabang_id;
        $survey->tanggal = $request->survey_kompetitor_tanggal;
        $survey->nama_kompetitor = $request->survey_kompetitor_nama_kompetitor;
        $survey->hasil_survey = $request->survey_kompetitor_hasil_survey;
        $survey->promo_kompetitor = $request->survey_kompetitor_promo_kompetitor;

        // dev
        // if($request->hasFile('survey_kompetitor_foto')) {
        //     $file = $request->file('survey_kompetitor_foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('public/file/labul/', $filename);
        //     $survey->foto = $filename;
        // }
        // prod
        if($request->hasFile('survey_kompetitor_foto')) {
          $file = $request->file('survey_kompetitor_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $survey->foto = $filename;
        }

        $survey->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // komplain
    public function inputKomplain()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputKomplainStore(Request $request)
    {
        $komplain = new LabulKomplain;
        $komplain->karyawan_id = Auth::user()->master_karyawan_id;
        $komplain->cabang_id = $request->komplain_cabang_id;
        $komplain->tanggal = $request->komplain_tanggal;
        $komplain->nama_customer = $request->komplain_nama_customer;
        $komplain->nomor_hp = $request->komplain_nomor_hp;
        $komplain->kritik_saran = $request->komplain_kritik_saran;
        $komplain->penanganan_awal = $request->komplain_penanganan_awal;
        $komplain->save();
    }

    // data instansi
    public function inputDataInstansi()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputDataInstansiStore(Request $request)
    {
        $data_instansi = new LabulDataInstansi;
        $data_instansi->karyawan_id = Auth::user()->master_karyawan_id;
        $data_instansi->cabang_id = $request->data_instansi_cabang_id;
        $data_instansi->tanggal = $request->data_instansi_tanggal;
        $data_instansi->pic = $request->data_instansi_pic;
        $data_instansi->nama_instansi = $request->data_instansi_nama_instansi;
        $data_instansi->nomor_hp = $request->data_instansi_nomor_hp;
        $data_instansi->alamat = $request->data_instansi_alamat;
        $data_instansi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // reqor
    public function inputReqor()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      return response()->json([
        'cabangs' => $cabang,
        'cabang_id' => $cabang_id
      ]);
    }

    public function inputReqorStore(Request $request)
    {
        $reqor = new LabulReqor;
        $reqor->karyawan_id = Auth::user()->master_karyawan_id;
        $reqor->cabang_id = $request->reqor_cabang_id;
        $reqor->tanggal = $request->reqor_tanggal;
        $reqor->nama_customer = $request->reqor_nama_customer;
        $reqor->nomor_hp = $request->reqor_nomor_hp;
        $reqor->request_produk = $request->reqor_request_produk;
        $reqor->produk_tertolak = $request->reqor_produk_tertolak;
        $reqor->alasan = $request->reqor_alasan;
        $reqor->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    // omzet cabang
    public function inputOmzetCabang()
    {
        $cabang = MasterCabang::get();
        $sales = MasterKaryawan::where('master_jabatan_id', '56')->where('status', 'Aktif')->get();
        
        return response()->json([
            'cabangs' => $cabang,
            'sales' => $sales
        ]);
    }
    public function inputOmzetCabangForm()
    {
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }
      
      $sales = MasterKaryawan::where('master_jabatan_id', '56')->where('status', 'Aktif')->where('master_cabang_id', $cabang_id)->get();

      return view('pages.labul.input.omzet', ['cabang' => $cabang, 'sales' => $sales]);
    }
    public function inputOmzetCabangStore(Request $request)
    {
      $omzet = new LabulOmzet;
      $omzet->karyawan_id = Auth::user()->master_karyawan_id;
      $omzet->cabang_id = $request->omzet_cabang_cabang_id;
      $omzet->tanggal = $request->omzet_cabang_tanggal;
      $omzet->transaksi = $request->omzet_cabang_transaksi;
      $omzet->traffic_online = $request->omzet_cabang_traffic_online;
      $omzet->traffic_offline = $request->omzet_cabang_traffic_offline;
      $omzet->retail = str_replace(",", "", $request->omzet_cabang_retail);
      $omzet->instansi = str_replace(",", "", $request->omzet_cabang_instansi);
      $omzet->reseller = str_replace(",", "", $request->omzet_cabang_reseller);
      $omzet->cabang_rp = str_replace(",", "", $request->omzet_cabang_cabang);
      $omzet->omzet_harian = str_replace(",", "", $request->omzet_cabang_omzet_harian);
      $omzet->omzet_terbayar = str_replace(",", "", $request->omzet_cabang_omzet_terbayar);
      $omzet->leads = $request->omzet_cabang_leads;
      $omzet->konsumen_bertanya = $request->omzet_cabang_konsumen_bertanya;
      $omzet->cetak_banner_harian = str_replace(",", "", $request->omzet_cabang_cetak_banner_harian);
      $omzet->cetak_a3_harian = str_replace(",", "", $request->omzet_cabang_cetak_a3_harian);
      $omzet->print_outdoor = str_replace(",", "", $request->omzet_cabang_print_outdoor);
      $omzet->print_indoor = str_replace(",", "", $request->omzet_cabang_print_indoor);
      $omzet->offset = str_replace(",", "", $request->omzet_cabang_offset);
      $omzet->merchandise = str_replace(",", "", $request->omzet_cabang_merchandise);
      $omzet->akrilik = str_replace(",", "", $request->omzet_cabang_akrilik);
      $omzet->design = str_replace(",", "", $request->omzet_cabang_design);
      $omzet->laminasi_dingin = str_replace(",", "", $request->omzet_cabang_laminasi_dingin);
      $omzet->laminasi_a3 = str_replace(",", "", $request->omzet_cabang_laminasi_a3);
      $omzet->fotocopy = str_replace(",", "", $request->omzet_cabang_fotocopy);
      $omzet->dtf = str_replace(",", "", $request->omzet_cabang_dtf);
      $omzet->uv = str_replace(",", "", $request->omzet_cabang_uv);
      $omzet->advertising_produk = str_replace(",", "", $request->omzet_cabang_advertising_produk);
      $omzet->advertising_jasa = str_replace(",", "", $request->omzet_cabang_advertising_jasa);
      $omzet->cash_harian = str_replace(",", "", $request->omzet_cabang_cash_harian);
      $omzet->piutang_bulan_berjalan = str_replace(",", "", $request->omzet_cabang_piutang_bulan_berjalan);
      $omzet->piutang_terbayar = str_replace(",", "", $request->omzet_cabang_piutang_terbayar);
      // $omzet->karyawan_sales_id = str_replace(",", "", $request->omzet_cabang_karyawan_sales_id);
      // $omzet->pencapaian_omset_sales = str_replace(",", "", $request->omzet_cabang_pencapaian_omset_sales);
      // $omzet->pencapaian_cash_sales = str_replace(",", "", $request->omzet_cabang_pencapaian_cash_sales);
      $omzet->save();

      if ($request->omzet_cabang_karyawan_sales_id) {
        foreach ($request->omzet_cabang_karyawan_sales_id as $key => $item_sales) {
          $omzet_sales = new LabulOmzetSales;
          $omzet_sales->omzet_id = $omzet->id;
          $omzet_sales->karyawan_id = $item_sales;
          $omzet_sales->pencapaian_omzet = str_replace(",", "", $request->omzet_cabang_pencapaian_omset_sales[$key]);
          $omzet_sales->pencapaian_cash = str_replace(",", "", $request->omzet_cabang_pencapaian_cash_sales[$key]);
          $omzet_sales->save();
        }
      }

      // return response()->json([
      //     'status' => 'true'
      // ]);
      return redirect()->route('labul.input');
    }

    // result
    public function result()
    {
        // $a = LabulActivityPlanDetail::select(DB::raw('COUNT(jenis_rencana) AS tes', 'activity_plan_id', 'jenis_rencana'), DB::raw('activity_plan_id AS a'))
        // ->groupBy('activity_plan_id', 'jenis_rencana')
        // ->get();

        // dd($a);
        $cabangs = MasterCabang::get();

        // $activity_plan = LabulActivityPlan::limit('1')->get();
        // $data_member = LabulDataMember::limit('1')->get();
        // $reseller = LabulReseller::limit('1')->get();
        // $data_reseller = LabulDataReseller::limit('1')->get();
        // $instansi = LabulInstansi::limit('1')->get();
        // $survey = LabulSurveyKompetitor::limit('1')->get();
        // $komplain = LabulKomplain::limit('1')->get();
        // $data_instansi = LabulDataInstansi::limit('1')->get();
        // $reqor = LabulReqor::limit('1')->get();
        // $omzet = LabulOmzet::orderBy('id', 'desc')->limit('1')->get();

        return view('pages.labul.result.index', [
            'cabangs' => $cabangs,
            // 'activity_plans' => $activity_plan,
            // 'data_members' => $data_member,
            // 'resellers' => $reseller,
            // 'data_resellers' => $data_reseller,
            // 'instansis' => $instansi,
            // 'surveys' => $survey,
            // 'komplains' => $komplain,
            // 'data_instansis' => $data_instansi,
            // 'reqors' => $reqor,
            // 'omzets' => $omzet
        ]);
    }

    // result activity plan
    public function resultActivityPlanCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $activity_plan = LabulActivityPlan::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $activity_plan = LabulActivityPlan::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'activity_plans' => $activity_plan
      ]);
    }

    public function resultActivityPlanDetail($id)
    {
      $activity_plan = LabulActivityPlan::with('cabang')->find($id);
      $activity_plan_jumlah = LabulActivityPlanJumlah::where('activity_plan_id', $activity_plan->id)->get();
      $activity_plan_rencana = LabulActivityPlanRencana::where('activity_plan_id', $activity_plan->id)->get();

      return response()->json([
        'activity_plan' => $activity_plan,
        'activity_plan_jumlah' => $activity_plan_jumlah,
        'activity_plan_rencana' => $activity_plan_rencana
      ]);
    }

    public function resultActivityPlanEdit($id)
    {
      $activity_plan = LabulActivityPlan::with('cabang')->find($id);
      $activity_plan_jumlah = LabulActivityPlanJumlah::where('activity_plan_id', $activity_plan->id)->get();
      $activity_plan_rencana = LabulActivityPlanRencana::where('activity_plan_id', $activity_plan->id)->get();

      return response()->json([
        'activity_plan' => $activity_plan,
        'activity_plan_jumlah' => $activity_plan_jumlah,
        'activity_plan_rencana' => $activity_plan_rencana
      ]);
    }

    public function resultActivityPlanUpdate(Request $request, $id)
    {
      $activity_plan = LabulActivityPlan::find($id);
      $activity_plan->karyawan_id = Auth::user()->master_karyawan_id;
      $activity_plan->cabang_id = $request->edit_activity_plan_cabang_id;
      $activity_plan->tanggal = $request->edit_activity_plan_tanggal;
      $activity_plan->save();

      $activity_plan_jumlah = LabulActivityPlanJumlah::where('activity_plan_id', $activity_plan->id);
      $activity_plan_jumlah->delete();

      $activity_plan_rencana = LabulActivityPlanRencana::where('activity_plan_id', $activity_plan->id);
      $activity_plan_rencana->delete();

      // labul jumlah rencana
      if ($request->edit_activity_plan_jumlah_rencana_kunjungan) {
        $activity_plan_jumlah_rencana_kunjungan = new LabulActivityPlanJumlah;
        $activity_plan_jumlah_rencana_kunjungan->activity_plan_id = $activity_plan->id;
        $activity_plan_jumlah_rencana_kunjungan->nama = "Jumlah Rencana Kunjungan";
        $activity_plan_jumlah_rencana_kunjungan->jumlah = $request->edit_activity_plan_jumlah_rencana_kunjungan;
        $activity_plan_jumlah_rencana_kunjungan->save();
      }

      if ($request->edit_activity_plan_jumlah_rencana_salescall) {
        $activity_plan_jumlah_rencana_salescall = new LabulActivityPlanJumlah;
        $activity_plan_jumlah_rencana_salescall->activity_plan_id = $activity_plan->id;
        $activity_plan_jumlah_rencana_salescall->nama = "Jumlah Rencana Salescall";
        $activity_plan_jumlah_rencana_salescall->jumlah = $request->edit_activity_plan_jumlah_rencana_salescall;
        $activity_plan_jumlah_rencana_salescall->save();
      }

      if ($request->edit_activity_plan_jumlah_rencana_sebar_brosur) {
        $activity_plan_jumlah_rencana_sebar_brosur = new LabulActivityPlanJumlah;
        $activity_plan_jumlah_rencana_sebar_brosur->activity_plan_id = $activity_plan->id;
        $activity_plan_jumlah_rencana_sebar_brosur->nama = "Jumlah Rencana Sebar Brosur";
        $activity_plan_jumlah_rencana_sebar_brosur->jumlah = $request->edit_activity_plan_jumlah_rencana_sebar_brosur;
        $activity_plan_jumlah_rencana_sebar_brosur->save();
      }

      if ($request->edit_activity_plan_jumlah_rencana_penawaran) {
        $activity_plan_jumlah_rencana_penawaran = new LabulActivityPlanJumlah;
        $activity_plan_jumlah_rencana_penawaran->activity_plan_id = $activity_plan->id;
        $activity_plan_jumlah_rencana_penawaran->nama = "Jumlah Rencana Penawaran";
        $activity_plan_jumlah_rencana_penawaran->jumlah = $request->edit_activity_plan_jumlah_rencana_penawaran;
        $activity_plan_jumlah_rencana_penawaran->save();
      }

      if ($request->edit_activity_plan_jumlah_penawaran_merchant) {
        $activity_plan_jumlah_penawaran_merchant = new LabulActivityPlanJumlah;
        $activity_plan_jumlah_penawaran_merchant->activity_plan_id = $activity_plan->id;
        $activity_plan_jumlah_penawaran_merchant->nama = "Jumlah Penawaran Merchant";
        $activity_plan_jumlah_penawaran_merchant->jumlah = $request->edit_activity_plan_jumlah_penawaran_merchant;
        $activity_plan_jumlah_penawaran_merchant->save();
      }

      // labul rencana
      if ($request->edit_activity_plan_rencana_kunjungan) {
        foreach ($request->edit_activity_plan_rencana_kunjungan as $key => $value) {
            $activity_plan_rencana_kunjungan = new LabulActivityPlanRencana;
            $activity_plan_rencana_kunjungan->activity_plan_id = $activity_plan->id;
            $activity_plan_rencana_kunjungan->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_kunjungan->id;
            $activity_plan_rencana_kunjungan->nama = $value;
            $activity_plan_rencana_kunjungan->save();
        }
      }

      if ($request->edit_activity_plan_rencana_salescall) {
        foreach ($request->edit_activity_plan_rencana_salescall as $key => $value) {
            $activity_plan_rencana_salescall = new LabulActivityPlanRencana;
            $activity_plan_rencana_salescall->activity_plan_id = $activity_plan->id;
            $activity_plan_rencana_salescall->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_salescall->id;
            $activity_plan_rencana_salescall->nama = $value;
            $activity_plan_rencana_salescall->save();
        }
      }

      if ($request->edit_activity_plan_rencana_sebar_brosur) {
        foreach ($request->edit_activity_plan_rencana_sebar_brosur as $key => $value) {
            $activity_plan_rencana_sebar_brosur = new LabulActivityPlanRencana;
            $activity_plan_rencana_sebar_brosur->activity_plan_id = $activity_plan->id;
            $activity_plan_rencana_sebar_brosur->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_sebar_brosur->id;
            $activity_plan_rencana_sebar_brosur->nama = $value;
            $activity_plan_rencana_sebar_brosur->save();
        }
      }

      if ($request->edit_activity_plan_rencana_penawaran) {
        foreach ($request->edit_activity_plan_rencana_penawaran as $key => $value) {
            $activity_plan_rencana_penawaran = new LabulActivityPlanRencana;
            $activity_plan_rencana_penawaran->activity_plan_id = $activity_plan->id;
            $activity_plan_rencana_penawaran->activity_plan_jumlah_id = $activity_plan_jumlah_rencana_penawaran->id;
            $activity_plan_rencana_penawaran->nama = $value;
            $activity_plan_rencana_penawaran->save();
        }
      }

      if ($request->edit_activity_plan_penawaran_merchant) {
        foreach ($request->edit_activity_plan_penawaran_merchant as $key => $value) {
            $activity_plan_penawaran_merchant = new LabulActivityPlanRencana;
            $activity_plan_penawaran_merchant->activity_plan_id = $activity_plan->id;
            $activity_plan_penawaran_merchant->activity_plan_jumlah_id = $activity_plan_jumlah_penawaran_merchant->id;
            $activity_plan_penawaran_merchant->nama = $value;
            $activity_plan_penawaran_merchant->save();
        }
      }

      return response()->json([
        'tes' => $request->all(),
        'id' => $id
      ]);
    }

    public function resultActivityPlanDelete(Request $request)
    {
      $activity_plan = LabulActivityPlan::find($request->id);

      $activity_plan_jumlah = LabulActivityPlanJumlah::where('activity_plan_id', $activity_plan->id);
      $activity_plan_jumlah->delete();

      $activity_plan_rencana = LabulActivityPlanRencana::where('activity_plan_id', $activity_plan->id);
      $activity_plan_rencana->delete();

      $activity_plan->delete();
    }

    public function resultExportActivityPlan(Request $request)
    {
        $startDate = $request->activity_plan_start_date . " 00:00:00";
        $endDate = $request->activity_plan_end_date . " 23:59:00";
        $cabang_id = $request->activity_plan_cabang_id;

        return Excel::download(new LabulActivityPlanExport($startDate, $endDate, $cabang_id), 'activity_plan.xlsx');
    }

    // result data instansi
    public function resultExportDataInstansi(Request $request)
    {
        $startDate = $request->data_instansi_start_date . " 00:00:00";
        $endDate = $request->data_instansi_end_date . " 23:59:00";
        $cabang_id = $request->data_instansi_cabang_id;

        return Excel::download(new LabulDataInstansiExport($startDate, $endDate, $cabang_id), 'data_instansi.xlsx');
    }

    public function resultDataInstansiCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $data_instansi = LabulDataInstansi::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $data_instansi = LabulDataInstansi::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'data_instansis' => $data_instansi
      ]);
    }

    public function resultDataInstansiDetail($id)
    {
      $data_instansi = LabulDataInstansi::with('cabang')->find($id);

      return response()->json([
        'data_instansi' => $data_instansi
      ]);
    }

    public function resultDataInstansiEdit($id)
    {
      $data_instansi = LabulDataInstansi::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'data_instansi' => $data_instansi,
        'cabangs' => $cabang
      ]);
    }

    public function resultDataInstansiUpdate(Request $request, $id)
    {
      $data_instansi = LabulDataInstansi::find($id);
      $data_instansi->karyawan_id = Auth::user()->master_karyawan_id;
      $data_instansi->cabang_id = $request->edit_data_instansi_cabang_id;
      $data_instansi->tanggal = $request->edit_data_instansi_tanggal;
      $data_instansi->nama_instansi = $request->edit_data_instansi_nama_instansi;
      $data_instansi->pic = $request->edit_data_instansi_pic;
      $data_instansi->nomor_hp = $request->edit_data_instansi_nomor_hp;
      $data_instansi->alamat = $request->edit_data_instansi_alamat;
      $data_instansi->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultDataInstansiDelete(Request $request)
    {
      $data_instansi = LabulDataInstansi::find($request->id);
      $data_instansi->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result data member
    public function resultExportDataMember(Request $request)
    {
        $startDate = $request->data_member_start_date . " 00:00:00";
        $endDate = $request->data_member_end_date . " 23:59:00";
        $cabang_id = $request->data_member_cabang_id;

        return Excel::download(new LabulDataMemberExport($startDate, $endDate, $cabang_id), 'data_member.xlsx');
    }

    public function resultDataMemberCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $data_member = LabulDataMember::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $data_member = LabulDataMember::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'data_members' => $data_member
      ]);
    }

    public function resultDataMemberDetail($id)
    {
      $data_member = LabulDataMember::with('cabang')->find($id);

      return response()->json([
        'data_member' => $data_member
      ]);
    }

    public function resultDataMemberEdit($id)
    {
      $data_member = LabulDataMember::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'data_member' => $data_member,
        'cabangs' => $cabang
      ]);
    }

    public function resultDataMemberUpdate(Request $request, $id)
    {
      $data_member = LabulDataMember::find($id);
      $data_member->karyawan_id = Auth::user()->master_karyawan_id;
      $data_member->cabang_id = $request->edit_data_member_cabang_id;
      $data_member->tanggal = $request->edit_data_member_tanggal;
      $data_member->nama_member = $request->edit_data_member_nama_member;
      $data_member->nomor_hp = $request->edit_data_member_nomor_hp;
      $data_member->alamat = $request->edit_data_member_alamat;
      $data_member->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultDataMemberDelete(Request $request)
    {
      $data_member = LabulDataMember::find($request->id);
      $data_member->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result data reseller
    public function resultExportDataReseller(Request $request)
    {
        $startDate = $request->data_reseller_start_date . " 00:00:00";
        $endDate = $request->data_reseller_end_date . " 23:59:00";
        $cabang_id = $request->data_reseller_cabang_id;

        return Excel::download(new LabulDataResellerExport($startDate, $endDate, $cabang_id), 'data_reseller.xlsx');
    }

    public function resultDataResellerCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $data_reseller = LabulDataReseller::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $data_reseller = LabulDataReseller::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'data_resellers' => $data_reseller
      ]);
    }

    public function resultDataResellerDetail($id)
    {
      $data_reseller = LabulDataReseller::with('cabang')->find($id);

      return response()->json([
        'data_reseller' => $data_reseller
      ]);
    }

    public function resultDataResellerEdit($id)
    {
      $data_reseller = LabulDataReseller::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'data_reseller' => $data_reseller,
        'cabangs' => $cabang
      ]);
    }

    public function resultDataResellerUpdate(Request $request, $id)
    {
      $data_reseller = LabulDataReseller::find($id);
      $data_reseller->karyawan_id = Auth::user()->master_karyawan_id;
      $data_reseller->cabang_id = $request->edit_data_reseller_cabang_id;
      $data_reseller->tanggal = $request->edit_data_reseller_tanggal;
      $data_reseller->nama_reseller = $request->edit_data_reseller_nama_reseller;
      $data_reseller->nama_usaha = $request->edit_data_reseller_nama_usaha;
      $data_reseller->nomor_hp = $request->edit_data_reseller_nomor_hp;
      $data_reseller->alamat = $request->edit_data_reseller_alamat;
      $data_reseller->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultDataResellerDelete(Request $request)
    {
      $data_reseller = LabulDataReseller::find($request->id);
      $data_reseller->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result instansi
    public function resultExportInstansi(Request $request)
    {
        $startDate = $request->instansi_start_date . " 00:00:00";
        $endDate = $request->instansi_end_date . " 23:59:00";
        $cabang_id = $request->instansi_cabang_id;

        return Excel::download(new LabulInstansiExport($startDate, $endDate, $cabang_id), 'instansi.xlsx');
    }

    public function resultInstansiCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $instansi = LabulInstansi::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $instansi = LabulInstansi::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'instansis' => $instansi
      ]);
    }

    public function resultInstansiDetail($id)
    {
      $instansi = LabulInstansi::with(['cabang', 'dataInstansi'])->find($id);

      return response()->json([
        'instansi' => $instansi
      ]);
    }

    public function resultInstansiEdit($id)
    {
      $instansi = LabulInstansi::with('cabang')->find($id);
      $cabang = MasterCabang::get();
      $data_instansi = LabulDataInstansi::get();

      return response()->json([
        'instansi' => $instansi,
        'cabangs' => $cabang,
        'data_instansis' => $data_instansi
      ]);
    }

    public function resultInstansiUpdate(Request $request, $id)
    {
      $instansi = LabulInstansi::find($id);
      $instansi->karyawan_id = Auth::user()->master_karyawan_id;
      $instansi->cabang_id = $request->edit_instansi_cabang_id;
      $instansi->tanggal = $request->edit_instansi_tanggal;
      $instansi->instansi_id = $request->edit_instansi_instansi_id;

      // dev
      // if($request->hasFile('edit_instansi_foto')) {
      //   if (file_exists("public/file/labul/" . $instansi->foto)) {
      //     File::delete("public/file/labul/" . $instansi->foto);
      //   }
      //   $file = $request->file('edit_instansi_foto');
      //   $extension = $file->getClientOriginalExtension();
      //   $filename = time() . "." . $extension;
      //   $file->move('public/file/labul/', $filename);
      //   $instansi->foto = $filename;
      // }

      // prod
      if($request->hasFile('edit_instansi_foto')) {
          if (file_exists("file/labul/" . $instansi->foto)) {
              File::delete("file/labul/" . $instansi->foto);
          }
          $file = $request->file('edit_instansi_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $instansi->foto = $filename;
      }

      $instansi->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultInstansiDelete(Request $request)
    {
      $instansi = LabulInstansi::find($request->id);

      // dev
      // if (file_exists("public/file/labul/" . $instansi->foto)) {
      //   File::delete("public/file/labul/" . $instansi->foto);
      // }

      // prod
      if (file_exists("file/labul/" . $instansi->foto)) {
          File::delete("file/labul/" . $instansi->foto);
      }
      
      $instansi->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result komplain
    public function resultExportKomplain(Request $request)
    {
        $startDate = $request->komplain_start_date . " 00:00:00";
        $endDate = $request->komplain_end_date . " 23:59:00";
        $cabang_id = $request->komplain_cabang_id;

        return Excel::download(new LabulKomplainExport($startDate, $endDate, $cabang_id), 'komplain.xlsx');
    }

    public function resultKomplainCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $komplain = LabulKomplain::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $komplain = LabulKomplain::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'komplains' => $komplain
      ]);
    }

    public function resultKomplainDetail($id)
    {
      $komplain = LabulKomplain::with('cabang')->find($id);

      return response()->json([
        'komplain' => $komplain
      ]);
    }

    public function resultKomplainEdit($id)
    {
      $komplain = LabulKomplain::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'komplain' => $komplain,
        'cabangs' => $cabang
      ]);
    }

    public function resultKomplainUpdate(Request $request, $id)
    {
      $komplain = LabulKomplain::find($id);
      $komplain->karyawan_id = Auth::user()->master_karyawan_id;
      $komplain->cabang_id = $request->edit_komplain_cabang_id;
      $komplain->tanggal = $request->edit_komplain_tanggal;
      $komplain->nama_customer = $request->edit_komplain_nama_customer;
      $komplain->nomor_hp = $request->edit_komplain_nomor_hp;
      $komplain->kritik_saran = $request->edit_komplain_kritik_saran;
      $komplain->penanganan_awal = $request->edit_komplain_penanganan_awal;
      $komplain->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultKomplainDelete(Request $request)
    {
      $komplain = LabulKomplain::find($request->id);
      $komplain->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result omzet
    public function resultExportOmzet(Request $request)
    {
        $startDate = $request->omzet_start_date . " 00:00:00";
        $endDate = $request->omzet_end_date . " 23:59:00";
        $cabang_id = $request->omzet_cabang_id;

        if ($cabang_id) {
          $data_cabang = MasterCabang::find($cabang_id);
          $cabang = $data_cabang->nama_cabang . "_";
        } else {
          $cabang = "";
        }

        return Excel::download(new LabulOmzetExport($startDate, $endDate, $cabang_id), $cabang . 'omzet.xlsx');
    }

    public function resultOmzetCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $omzet = LabulOmzet::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $omzet = LabulOmzet::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'omzets' => $omzet
      ]);
    }

    public function resultOmzetDetail($id)
    {
      $omzet = LabulOmzet::with(['cabang', 'sales'])->find($id);

      return response()->json([
        'omzet' => $omzet
      ]);
    }

    public function resultOmzetEdit($id)
    {
      $omzet = LabulOmzet::with('sales')->find($id);
      $cabang = MasterCabang::get();

      if (Auth::user()->masterKaryawan) {
        $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
      } else {
        $cabang_id = 0;
      }

      $sales = MasterKaryawan::where('master_jabatan_id', '56')->where('status', 'Aktif')->where('master_cabang_id', $cabang_id)->get();
      $omzet_sales = LabulOmzetSales::where('omzet_id', $omzet->id)->get();
      

      // return response()->json([
      //   'omzet' => $omzet,
      //   'cabangs' => $cabang,
      //   'sales' => $sales
      // ]);
      return view('pages.labul.result.omzetEdit', [
        'omzet' => $omzet,
        'cabang' => $cabang,
        'sales' => $sales,
        'omzet_sales' => $omzet_sales
      ]);
    }

    public function resultOmzetUpdate(Request $request, $id)
    {
      $omzet = LabulOmzet::find($id);
      $omzet->karyawan_id = Auth::user()->master_karyawan_id;
      $omzet->cabang_id = $request->edit_omzet_cabang_id;
      $omzet->tanggal = $request->edit_omzet_tanggal;
      $omzet->transaksi = $request->edit_omzet_transaksi;
      $omzet->traffic_online = $request->edit_omzet_traffic_online;
      $omzet->traffic_offline = $request->edit_omzet_traffic_offline;
      $omzet->retail = str_replace(",", "", $request->edit_omzet_retail);
      $omzet->instansi = str_replace(",", "", $request->edit_omzet_instansi);
      $omzet->reseller = str_replace(",", "", $request->edit_omzet_reseller);
      $omzet->cabang_rp = str_replace(",", "", $request->edit_omzet_cabang_rp);
      $omzet->omzet_harian = str_replace(",", "", $request->edit_omzet_omzet_harian);
      $omzet->omzet_terbayar = str_replace(",", "", $request->edit_omzet_omzet_terbayar);
      $omzet->leads = $request->edit_omzet_leads;
      $omzet->konsumen_bertanya = $request->edit_omzet_konsumen_bertanya;
      $omzet->cetak_banner_harian = str_replace(",", "", $request->edit_omzet_cetak_banner_harian);
      $omzet->cetak_a3_harian = str_replace(",", "", $request->edit_omzet_cetak_a3_harian);
      $omzet->print_outdoor = str_replace(",", "", $request->edit_omzet_print_outdoor);
      $omzet->print_indoor = str_replace(",", "", $request->edit_omzet_print_indoor);
      $omzet->offset = str_replace(",", "", $request->edit_omzet_offset);
      $omzet->merchandise = str_replace(",", "", $request->edit_omzet_merchandise);
      $omzet->akrilik = str_replace(",", "", $request->edit_omzet_akrilik);
      $omzet->design = str_replace(",", "", $request->edit_omzet_design);
      $omzet->laminasi_dingin = str_replace(",", "", $request->edit_omzet_laminasi_dingin);
      $omzet->laminasi_a3 = str_replace(",", "", $request->edit_omzet_laminasi_a3);
      $omzet->fotocopy = str_replace(",", "", $request->edit_omzet_fotocopy);
      $omzet->dtf = str_replace(",", "", $request->edit_omzet_dtf);
      $omzet->uv = str_replace(",", "", $request->edit_omzet_uv);
      $omzet->advertising_produk = str_replace(",", "", $request->edit_omzet_advertising_produk);
      $omzet->advertising_jasa = str_replace(",", "", $request->edit_omzet_advertising_jasa);
      $omzet->cash_harian = str_replace(",", "", $request->edit_omzet_cash_harian);
      $omzet->piutang_bulan_berjalan = str_replace(",", "", $request->edit_omzet_piutang_bulan_berjalan);
      $omzet->piutang_terbayar = str_replace(",", "", $request->edit_omzet_piutang_terbayar);
      // $omzet->karyawan_sales_id = str_replace(",", "", $request->edit_omzet_karyawan_sales_id);
      // $omzet->pencapaian_omset_sales = str_replace(",", "", $request->edit_omzet_pencapaian_omzet_sales);
      // $omzet->pencapaian_cash_sales = str_replace(",", "", $request->edit_omzet_pencapaian_cash_sales);
      $omzet->save();

      $omzet_cabang_karyawan_sales_id = $request->omzet_cabang_karyawan_sales_id;
      if ($omzet_cabang_karyawan_sales_id) {
        $omzet_sales_cek = LabulOmzetSales::where('omzet_id', $omzet->id)->first();
        if ($omzet_sales_cek) {
          $omzet_sales_ = LabulOmzetSales::where('omzet_id', $omzet->id);
          $omzet_sales_->delete();
        }
        
        foreach ($omzet_cabang_karyawan_sales_id as $key => $item_sales) {
          $omzet_sales = new LabulOmzetSales;
          $omzet_sales->omzet_id = $omzet->id;
          $omzet_sales->karyawan_id = $item_sales;
          $omzet_sales->pencapaian_omzet = str_replace(",", "", $request->omzet_cabang_pencapaian_omset_sales[$key]);
          $omzet_sales->pencapaian_cash = str_replace(",", "", $request->omzet_cabang_pencapaian_cash_sales[$key]);
          $omzet_sales->save();
        }
      }

      // return response()->json([
      //   'status' => 200
      // ]);

      return redirect()->route('labul.result');
    }

    public function resultOmzetDelete(Request $request)
    {
      $omzet = LabulOmzet::find($request->id);

      $omzet_sales = LabulOmzetSales::where('omzet_id', $omzet->id)->get();
      if (count($omzet_sales) > 0) {
        $omzet_sales_ = LabulOmzetSales::where('omzet_id', $omzet->id);
        $omzet_sales_->delete();
      }

      $omzet->delete();

      return response()->json([
        'status' => 200
      ]); 
    }

    // result reqor
    public function resultExportReqor(Request $request)
    {
        $startDate = $request->reqor_start_date . " 00:00:00";
        $endDate = $request->reqor_end_date . " 23:59:00";
        $cabang_id = $request->reqor_cabang_id;

        return Excel::download(new LabulReqorExport($startDate, $endDate, $cabang_id), 'reqor.xlsx');
    }

    public function resultReqorCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $reqor = LabulReqor::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $reqor = LabulReqor::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'reqors' => $reqor
      ]);
    }

    public function resultReqorDetail($id)
    {
      $reqor = LabulReqor::with('cabang')->find($id);

      return response()->json([
        'reqor' => $reqor
      ]);
    }

    public function resultReqorEdit($id)
    {
      $reqor = LabulReqor::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'reqor' => $reqor,
        'cabangs' => $cabang
      ]);
    }

    public function resultReqorUpdate(Request $request, $id)
    {
      $reqor = LabulReqor::find($id);
      $reqor->karyawan_id = Auth::user()->master_karyawan_id;
      $reqor->cabang_id = $request->edit_reqor_cabang_id;
      $reqor->tanggal = $request->edit_reqor_tanggal;
      $reqor->nama_customer = $request->edit_reqor_nama_customer;
      $reqor->nomor_hp = $request->edit_reqor_nomor_hp;
      $reqor->request_produk = $request->edit_reqor_request_produk;
      $reqor->produk_tertolak = $request->edit_reqor_produk_tertolak;
      $reqor->alasan = $request->edit_reqor_alasan;
      $reqor->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultReqorDelete(Request $request)
    {
      $reqor = LabulReqor::find($request->id);
      $reqor->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // result reseller
    public function resultExportReseller(Request $request)
    {
        $startDate = $request->reseller_start_date . " 00:00:00";
        $endDate = $request->reseller_end_date . " 23:59:00";
        $cabang_id = $request->reseller_cabang_id;

        return Excel::download(new LabulResellerExport($startDate, $endDate, $cabang_id), 'reseller.xlsx');
    }

    public function resultResellerCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $reseller = LabulReseller::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $reseller = LabulReseller::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'resellers' => $reseller
      ]);
    }

    public function resultResellerDetail($id)
    {
      $reseller = LabulReseller::with(['cabang', 'dataReseller'])->find($id);

      return response()->json([
        'reseller' => $reseller
      ]);
    }
    
    public function resultResellerEdit($id)
    {
      $reseller = LabulReseller::find($id);
      $cabang = MasterCabang::get();
      $data_reseller = LabulDataReseller::get();

      return response()->json([
        'reseller' => $reseller,
        'cabangs' => $cabang,
        'data_resellers' => $data_reseller
      ]);
    }

    public function resultResellerUpdate(Request $request, $id)
    {
      $reseller = LabulReseller::find($id);
      $reseller->karyawan_id = Auth::user()->master_karyawan_id;
      $reseller->cabang_id = $request->edit_reseller_cabang_id;
      $reseller->tanggal = $request->edit_reseller_tanggal;
      $reseller->hasil_kunjungan = $request->edit_reseller_hasil_kunjungan;

      // dev
      // if($request->hasFile('edit_reseller_foto')) {
      //   if (file_exists("public/file/labul/" . $reseller->foto)) {
      //     File::delete("public/file/labul/" . $reseller->foto);
      //   }
      //   $file = $request->file('edit_reseller_foto');
      //   $extension = $file->getClientOriginalExtension();
      //   $filename = time() . "." . $extension;
      //   $file->move('public/file/labul/', $filename);
      //   $reseller->foto = $filename;
      // }

      // prod
      if($request->hasFile('edit_reseller_foto')) {
          if (file_exists("file/labul/" . $reseller->foto)) {
              File::delete("file/labul/" . $reseller->foto);
          }
          $file = $request->file('edit_reseller_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $reseller->foto = $filename;
      }

      $reseller->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultResellerDelete(Request $request)
    {
      $reseller = LabulReseller::find($request->id);

      // dev
      // if (file_exists("public/file/labul/" . $reseller->foto)) {
      //   File::delete("public/file/labul/" . $reseller->foto);
      // }

      // prod
      if (file_exists("file/labul/" . $reseller->foto)) {
          File::delete("file/labul/" . $reseller->foto);
      }

      $reseller->delete();

      return response()->json([
        'status' => 200
      ]); 
    }

    // result survey kompetitor
    public function resultExportSurveyKompetitor(Request $request)
    {
        $startDate = $request->survey_kompetitor_start_date . " 00:00:00";
        $endDate = $request->survey_kompetitor_end_date . " 23:59:00";
        $cabang_id = $request->survey_kompetitor_cabang_id;

        return Excel::download(new LabulSurveyKompetitorExport($startDate, $endDate, $cabang_id), 'survey_kompetitor.xlsx');
    }

    public function resultSurveyKompetitorCari(Request $request)
    {
      $startDate = $request->start_date . " 00:00:00";
      $endDate = $request->end_date . " 23:59:00";
      $cabang_id = $request->cabang_id;

      if ($cabang_id) {
        $survey_kompetitor = LabulSurveyKompetitor::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->where('cabang_id', $cabang_id)
          ->get();
      } else {
        $survey_kompetitor = LabulSurveyKompetitor::with(['karyawan', 'cabang'])
          ->whereBetween('tanggal', [$startDate, $endDate])
          ->get();
      }
      
      return response()->json([
        'survey_kompetitors' => $survey_kompetitor
      ]);
    }

    public function resultSurveyKompetitorDetail($id)
    {
      $survey_kompetitor = LabulSurveyKompetitor::with('cabang')->find($id);

      return response()->json([
        'survey_kompetitor' => $survey_kompetitor
      ]);
    }
    
    public function resultSurveyKompetitorEdit($id)
    {
      $survey_kompetitor = LabulSurveyKompetitor::find($id);
      $cabang = MasterCabang::get();

      return response()->json([
        'survey_kompetitor' => $survey_kompetitor,
        'cabangs' => $cabang
      ]);
    }

    public function resultSurveyKompetitorUpdate(Request $request, $id)
    {
      $survey_kompetitor = LabulSurveyKompetitor::find($id);
      $survey_kompetitor->karyawan_id = Auth::user()->master_karyawan_id;
      $survey_kompetitor->cabang_id = $request->edit_survey_kompetitor_cabang_id;
      $survey_kompetitor->tanggal = $request->edit_survey_kompetitor_tanggal;
      $survey_kompetitor->nama_kompetitor = $request->edit_survey_kompetitor_nama_kompetitor;
      $survey_kompetitor->hasil_survey = $request->edit_survey_kompetitor_hasil_survey;
      $survey_kompetitor->promo_kompetitor = $request->edit_survey_kompetitor_promo_kompetitor;

      // dev
      // if($request->hasFile('edit_survey_kompetitor_foto')) {
      //   if (file_exists("public/file/labul/" . $survey_kompetitor->foto)) {
      //     File::delete("public/file/labul/" . $survey_kompetitor->foto);
      //   }
      //   $file = $request->file('edit_survey_kompetitor_foto');
      //   $extension = $file->getClientOriginalExtension();
      //   $filename = time() . "." . $extension;
      //   $file->move('public/file/labul/', $filename);
      //   $survey_kompetitor->foto = $filename;
      // }

      // prod
      if($request->hasFile('edit_survey_kompetitor_foto')) {
          if (file_exists("file/labul/" . $survey_kompetitor->foto)) {
              File::delete("file/labul/" . $survey_kompetitor->foto);
          }
          $file = $request->file('edit_survey_kompetitor_foto');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . "." . $extension;
          $file->move('file/labul/', $filename);
          $survey_kompetitor->foto = $filename;
      }

      $survey_kompetitor->save();

      return response()->json([
        'status' => 200
      ]);
    }

    public function resultSurveyKompetitorDelete(Request $request)
    {
      $survey_kompetitor = LabulSurveyKompetitor::find($request->id);

      // dev
      // if (file_exists("public/file/labul/" . $survey_kompetitor->foto)) {
      //   File::delete("public/file/labul/" . $survey_kompetitor->foto);
      // }

      // prod
      if (file_exists("file/labul/" . $survey_kompetitor->foto)) {
          File::delete("file/labul/" . $survey_kompetitor->foto);
      }

      $survey_kompetitor->delete();

      return response()->json([
        'status' => 200
      ]); 
    }
}
