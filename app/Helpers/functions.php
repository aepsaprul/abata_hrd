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

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
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
