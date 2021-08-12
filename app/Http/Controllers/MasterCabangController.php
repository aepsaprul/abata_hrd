<?php

namespace App\Http\Controllers;

use App\Models\MasterCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabangs = MasterCabang::get();

        return view('master.cabang.index', ['cabangs' => $cabangs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cabangs = new MasterCabang;
        $cabangs->nama_cabang = $request->nama_cabang;
        $cabangs->created_by = Auth::user()->id;
        $cabangs->save();

        return redirect()->route('cabang.create')->with('status', 'Data cabang berhasil ditambah');
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
        $cabang = MasterCabang::find($id);

        return view('master.cabang.edit', ['cabang' => $cabang]);
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
        $cabang = MasterCabang::find($id);
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->updated_by = Auth::user()->id;
        $cabang->save();

        return redirect()->route('cabang.index')->with('status', 'Data cabang berhasil diperbaharui');
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
            $cabang = MasterCabang::find($id);
            
            $cabang->deleted_by = Auth::user()->id;
            $cabang->save();

			$cabang->delete();

			return redirect()->route('cabang.index')->with('status', 'Data cabang berhasil dihapus');
    }
}
