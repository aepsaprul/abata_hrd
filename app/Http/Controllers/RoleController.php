<?php

namespace App\Http\Controllers;

use App\Models\MasterRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = MasterRole::orderBy('hirarki', 'asc')->get();

        return view('pages.master.role.index', ['roles' => $role]);
    }

    public function store(Request $request)
    {
        $role = new MasterRole;
        $role->nama = $request->nama;
        $role->hirarki = $request->hirarki;
        $role->save();

        // activity_log($role, "role", "created");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $role = MasterRole::find($id);

        return response()->json([
            'id' => $role->id,
            'nama' => $role->nama,
            'hirarki' => $role->hirarki
        ]);
    }

    public function update(Request $request)
    {
        $role = MasterRole::find($request->id);
        $role->nama = $request->nama;
        $role->hirarki = $request->hirarki;
        $role->save();

        // activity_log($role, "role", "updated");

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $role = MasterRole::find($id);

        return response()->json([
            'id' => $role->id
        ]);
    }

    public function delete(Request $request)
    {
        $role = MasterRole::find($request->id);
        $role->delete();

        // activity_log($role, "role", "deleted");

        return response()->json([
            'status' => 'true'
        ]);
    }
    public function updateHirarki(Request $request){
        $role = MasterRole::find($request->id);
        $role->hirarki = $request->hirarki;
        $role->save();

        // activity_log($role, "role", "updated");

        return response()->json([
            'status' => 'true'
        ]);
    }
}
