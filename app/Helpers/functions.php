<?php
    /* Set active class
    -------------------------------------------------------- */

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;

    function set_active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    function rupiah($angka){
        $hasil =  number_format($angka,0, ',' , '.');
        return $hasil;
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . '-' . $pecahkan[1] . '-' . $pecahkan[0];
    }

    function activity_log($model, $log_name, $description) {
        $agent = new Agent();
        $browser = $agent->browser();
        $version_browser = $agent->version($browser);
        $device = $agent->device();
        $platform = $agent->platform();

        activity()
            ->useLog($log_name)
            ->performedOn($model)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'ip address' => request()->ip(),
                'browser' => $browser,
                'browser version' => $version_browser,
                'device' => $device,
                'platform' => $platform
            ])
            ->log($description);

        $lastLoggedActivity = Activity::all()->last();

        $lastLoggedActivity->subject; //returns an instance of an eloquent model
        $lastLoggedActivity->causer; //returns an instance of your user model
        $lastLoggedActivity->getExtraProperty('customProperty'); //returns 'customValue'
        $lastLoggedActivity->description; //returns 'Look mum, I logged something'
        $lastLoggedActivity->changes;
    }

    function terbilang($i){
      $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      
      if ($i < 12) return " " . $huruf[$i];
      elseif ($i < 20) return terbilang($i - 10) . " belas";
      elseif ($i < 100) return terbilang($i / 10) . " puluh" . terbilang($i % 10);
      elseif ($i < 200) return " seratus" . terbilang($i - 100);
      elseif ($i < 1000) return terbilang($i / 100) . " ratus" . terbilang($i % 100);
      elseif ($i < 2000) return " seribu" . terbilang($i - 1000);
      elseif ($i < 1000000) return terbilang($i / 1000) . " ribu" . terbilang($i % 1000);
      elseif ($i < 1000000000) return terbilang($i / 1000000) . " juta" . terbilang($i % 1000000);    
    }

    function tglCarbon($tanggal, $display) {
      $date = Carbon\Carbon::parse($tanggal)->locale('id');
      $date->settings(['formatFunction' => 'translatedFormat']);
      
      return $date->format($display);
    }
