<?php

namespace App\Providers;

use App\Models\HcNavAccess;
use App\Models\HcNavigasiAccess;
use App\Models\HcNavigasiButton;
use App\Models\HcNavMain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            if (Auth::check()) {

                $current_nav_button = HcNavigasiButton::whereHas('navigasiAccess', function ($query) {
                    $query->where('karyawan_id', Auth::user()->master_karyawan_id);
                })
                ->select('main_id')
                ->groupBy('main_id')
                ->get();

                $current_nav_button_sub = HcNavigasiButton::whereHas('navigasiAccess', function ($query) {
                    $query->where('karyawan_id', Auth::user()->master_karyawan_id);
                })
                ->select('sub_id')
                ->groupBy('sub_id')
                ->get();

                $navigasi = HcNavigasiAccess::with('navigasiButton')
                    ->whereHas('navigasiButton.navigasiSub', function ($query) {
                        $query->where('aktif', substr(Request::getPathInfo(), 1));
                    })
                    ->where('karyawan_id', Auth::user()->master_karyawan_id)->get();

                $data_navigasi = [];
                foreach ($navigasi as $key => $value) {
                    $data_navigasi[] = $value->navigasiButton->title;
                }

                // view
                $view->with('current_nav_button', $current_nav_button);
                $view->with('current_nav_button_sub', $current_nav_button_sub);
                $view->with('current_data_navigasi', $data_navigasi);
            }else {
                $view->with('current_nav_button', null);
                $view->with('current_nav_button_sub', null);
                $view->with('current_data_navigasi', null);
            }
        });
    }
}
