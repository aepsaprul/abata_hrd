<?php

namespace App\Providers;

use App\Models\HcNavAccess;
use App\Models\HcNavMain;
use Illuminate\Support\Facades\Auth;
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
                $current_nav_main = HcNavMain::whereHas('navAccess' , function ($query) { $query->where('user_id', Auth::user()->master_karyawan_id)->where('tampil', 'y'); })->get();

                $current_menu = HcNavAccess::whereHas('navSub' , function ($query) { $query->where('link', '!=', '#'); })->where('user_id', Auth::user()->master_karyawan_id)->where('tampil', 'y')->get();


                //...with this variable
                $view->with('current_nav_mains', $current_nav_main);
                $view->with('current_menus', $current_menu);
            }else {
                $view->with('current_nav_mains', null);
                $view->with('current_menus', null);
            }
        });
    }
}
