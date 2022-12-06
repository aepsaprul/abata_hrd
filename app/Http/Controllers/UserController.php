<?php

namespace App\Http\Controllers;

use App\Models\HcNavAccess;
use App\Models\HcNavigasiAccess;
use App\Models\HcNavigasiButton;
use App\Models\HcNavigasiMain;
use App\Models\HcNavigasiSub;
use App\Models\HcNavSub;
use App\Models\MasterKaryawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // $nav_access = HcNavAccess::with('masterKaryawan')
        //     ->select(DB::raw('count(*) as nav_access_count, user_id'))
        //     ->groupBy('user_id')
        //     ->orderBy('id', 'desc')
        //     ->get();

        $users = User::orderBy('id', 'desc')->get();
        // $users = User::where('master_karyawan_id', '!=', 0)->orderBy('id', 'desc')->get();

        return view('pages.master.user.index', ['users' => $users]);
    }

    public function create()
    {
        $karyawan = MasterKaryawan::with('masterCabang')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->doesntHave('navAccess')
            ->get();

        return response()->json([
            'karyawans' => $karyawan
        ]);
    }

    public function store(Request $request)
    {
        $nav_sub = HcNavSub::get();

        foreach ($nav_sub as $key => $item) {
            $nav_access = new HcNavAccess;
            $nav_access->user_id = $request->karyawan_id;
            $nav_access->main_id = $item->main_id;
            $nav_access->sub_id = $item->id;
            $nav_access->tampil = "n";
            $nav_access->tambah = "n";
            $nav_access->ubah = "n";
            $nav_access->hapus = "n";
            $nav_access->save();
        }

        activity_log($nav_access, "user", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function delete(Request $request)
    {
        $nav_access = HcNavAccess::where('user_id', $request->id);

        $log_delete = HcNavAccess::where('user_id', $request->id)->first();
        $nav_access_id = HcNavAccess::find($log_delete->id);

        $nav_access->delete();

        activity_log($nav_access_id, "user", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function access($id)
    {
        $user = User::find($id);

        $nav_access = HcNavigasiAccess::where('karyawan_id', $user->master_karyawan_id)->get();

        $nav_button = HcNavigasiButton::get();
        $nav_sub = HcNavigasiSub::get();
        $nav_main = HcNavigasiMain::with(['navigasiSub', 'navigasiSub.navigasiButton', 'navigasiButton'])
            ->get();

        $button = HcNavigasiButton::with('navigasiSub')
            ->select(DB::raw('count(sub_id) as total'), DB::raw('count(main_id) as mainid'), 'sub_id')
            ->groupBy('sub_id')
            ->get();

        $total_main = HcNavigasiButton::with('navigasiSub')
            ->select(DB::raw('count(main_id) as total_main'), 'main_id')
            ->groupBy('main_id')
            ->get();

        return response()->json([
            'karyawan_id' => $user->master_karyawan_id,
            'nav_access' => $nav_access,
            'nav_buttons' => $nav_button,
            'buttons' => $button,
            'total_main' => $total_main,
            'nav_subs' => $nav_sub,
            'nav_mains' => $nav_main
        ]);
    }

    public function accessStore(Request $request)
    {
        $nav_access = HcNavigasiAccess::where('karyawan_id', $request->karyawan_id);

        if ($nav_access) {
            $nav_access->delete();

            foreach ($request->data_navigasi as $key => $value) {
                $nav_access = new HcNavigasiAccess;
                $nav_access->karyawan_id = $request->karyawan_id;
                $nav_access->button_id = $value;
                $nav_access->save();
            }
        } else {
            foreach ($request->data_navigasi as $key => $value) {
                $nav_access = new HcNavigasiAccess;
                $nav_access->karyawan_id = $request->karyawan_id;
                $nav_access->button_id = $value;
                $nav_access->save();
            }
        }

        return response()->json([
            'status' => $request->all()
        ]);
    }
}
