<?php

namespace App\Http\Controllers;

use App\Models\HcCuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = HcCuti::get();

        return view('pages.cuti.index', ['cutis' => $cuti]);
    }

    public function deleteBtn($id)
    {
        $cuti = HcCuti::find($id);

        return response()->json([
            'id' => $cuti->id
        ]);
    }

    public function delete(Request $request)
    {
        $cuti = HcCuti::find($request->id);
        $cuti->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
