<?php

namespace App\Http\Controllers;

use App\Models\MasterDivisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisis = MasterDivisi::get();

        return view('divisi.index', ['divisis' => $divisis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $divisis = new MasterDivisi;
        $divisis->nama = $request->nama_divisi;
        $divisis->save();

        return redirect()->route('divisi.index')->with('status', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisi = MasterDivisi::find($id);

        return view('divisi.edit', ['divisi' => $divisi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $divisi = masterDivisi::find($id);
        $divisi->nama = $request->nama_divisi;
        $divisi->save();

        return redirect()->route('divisi.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $divisi = MasterDivisi::find($id);
        $divisi->delete();

        return redirect()->route('divisi.index')->with('status', 'Data berhasil dihapus');
    }
}
