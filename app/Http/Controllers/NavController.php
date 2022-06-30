<?php

namespace App\Http\Controllers;

use App\Models\HcNavMain;
use App\Models\HcNavSub;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function index()
    {
        $nav_main = HcNavMain::get();
        $nav_sub = HcNavSub::orderBy('main_id', 'asc')->get();

        return view('pages.master.nav.index', ['nav_mains' => $nav_main, 'nav_subs' => $nav_sub]);
    }

    public function mainStore(Request $request)
    {
        $nav_main = new HcNavMain;
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->aktif = $request->aktif;
        $nav_main->save();

        // activity_log($nav_main, "nav_main", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function subCreate()
    {
        $nav_main = HcNavMain::get();

        return response()->json([
            'nav_mains' => $nav_main
        ]);
    }

    public function subStore(Request $request)
    {
        $nav_sub = new HcNavSub;
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->aktif = $request->aktif;
        $nav_sub->save();

        // activity_log($nav_sub, "nav_sub", "created");

        return response()->json([
            'status' => 'Data menu sub berhasil ditambah'
        ]);
    }

    public function mainEdit($id)
    {
        $nav_main = HcNavMain::find($id);

        return response()->json([
            'id' => $nav_main->id,
            'title' => $nav_main->title,
            'link' => $nav_main->link,
            'icon' => $nav_main->icon,
            'aktif' => $nav_main->aktif
        ]);
    }

    public function subEdit($id)
    {
        $nav_sub = HcNavSub::find($id);
        $nav_main = HcNavMain::get();

        return response()->json([
            'id' => $nav_sub->id,
            'title' => $nav_sub->title,
            'link' => $nav_sub->link,
            'main_id' => $nav_sub->main_id,
            'aktif' => $nav_sub->aktif,
            'nav_mains' => $nav_main
        ]);
    }

    public function mainUpdate(Request $request)
    {
        $nav_main = HcNavMain::find($request->id);
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->aktif = $request->aktif;
        $nav_main->save();

        // activity_log($nav_main, "nav_main", "updated");

        return response()->json([
            'id' => $request->id,
            'status' => 'true',
            'title' => $request->title,
            'link' => $request->link,
            'icon' => $request->icon,
            'aktif' => $request->aktif
        ]);
    }

    public function subUpdate(Request $request)
    {
        $nav_sub = HcNavSub::find($request->id);
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->aktif = $request->aktif;
        $nav_sub->save();

        $nav_main = HcNavMain::find($request->main_id);

        // activity_log($nav_sub, "nav_sub", "updated");

        return response()->json([
            'id' => $request->id,
            'status' => 'Data menu sub berhasil diperbaharui',
            'title' => $request->title,
            'link' => $request->link,
            'main_title' => $nav_main->title,
            'aktif' => $request->aktif
        ]);
    }

    public function mainDeleteBtn($id)
    {
        $nav_main = HcNavMain::find($id);

        // activity_log($nav_main, "nav_main", "deleted");

        return response()->json([
            'id' => $nav_main->id,
            'title' => $nav_main->title
        ]);
    }

    public function mainDelete(Request $request)
    {
        $nav_main = HcNavMain::find($request->id);

        $nav_sub = HcNavSub::where('main_id', $request->id)->first();

        if ($nav_sub) {
            $status = "false";
        } else {
            $nav_main->delete();

            $status = "true";
        }

        return response()->json([
            'status' => $status,
            'title' => $nav_main->title
        ]);
    }

    public function subDeleteBtn($id)
    {
        $nav_sub = HcNavSub::find($id);

        return response()->json([
            'id' => $nav_sub->id,
            'title' => $nav_sub->title
        ]);
    }

    public function subDelete(Request $request)
    {
        $nav_sub = HcNavSub::find($request->id);
        $nav_sub->delete();

        // activity_log($nav_sub, "nav_sub", "deleted");

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
