<?php

namespace App\Http\Controllers;

use App\Models\HcPenggajian;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = HcPenggajian::get();

        return view('pages.penggajian.index', ['penggajians' => $penggajian]);
    }

    public function store(Request $request)
    {

    }

    public function deleteBtn($id)
    {

    }

    public function delete(Request $request)
    {

    }
}
