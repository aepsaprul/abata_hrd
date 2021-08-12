<?php

namespace App\Http\Controllers;

use App\Models\HcLoker;
use Illuminate\Http\Request;
use App\Models\MasterJabatan;
use Illuminate\Support\Facades\Auth;

class HcLokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokers = HcLoker::with('masterJabatan')->get();

        return view('loker.index', ['lokers' => $lokers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatans = MasterJabatan::get();

        return view('loker.create', ['jabatans' => $jabatans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lokers = new HcLoker;
        $lokers->master_jabatan_id = $request->master_jabatan_id;
        $lokers->created_by = Auth::user()->id;
        $lokers->save();

        return redirect()->route('loker.index')->with('status', 'Data berhasil disimpan');
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
        $loker = HcLoker::find($id);
        $jabatans = MasterJabatan::get();

        return view('loker.edit', ['loker' => $loker, 'jabatans' => $jabatans]);
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
        $loker = HcLoker::find($id);
        $loker->master_jabatan_id = $request->master_jabatan_id;
        $loker->updated_by = Auth::user()->id;
        $loker->save();

        return redirect()->route('loker.index')->with('status', 'Data berhasil diubah');
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
        $loker = HcLoker::find($id);
        $loker->deleted_by = Auth::user()->id;
        $loker->save();

        $loker->delete();

        return redirect()->route('loker.index')->with('status', 'Data loker berhasil dihapus');
    }
}
