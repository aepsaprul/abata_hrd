<?php

namespace App\Http\Controllers;

use App\Models\HcLamaran;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    public function index()
    {
        $lamaran = HcLamaran::get();

        return view('pages.lamaran.index', ['lamarans' => $lamaran]);
    }

    public function show($id)
    {

    }

    public function delete($id)
    {

    }

    public function rekrutmen($id)
    {

    }

    public function gagalInterview($id)
    {

    }

    public function interview($id)
    {

    }

    public function gagal($id)
    {

    }

    public function terima($id)
    {

    }

    public function berkas($id)
    {

    }
}
