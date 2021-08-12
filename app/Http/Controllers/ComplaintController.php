<?php

namespace App\Http\Controllers;

use App\Models\ComplaintCustomer;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = ComplaintCustomer::orderBy('id', 'desc')->get();

        return view('complaint.index', ['complaints' => $complaints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $complaint = ComplaintCustomer::find($id);

        return view('complaint.edit', ['complaint' => $complaint]);
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
        $validated = $request->validate = ([
            'nama_lengkap' => 'required',
            'telepon' => 'required',
            'email' => 'required|email:rfc,dns',
            'pengaduan' => 'required'
        ]);

        $complaints = ComplaintCustomer::find($id);
        $complaints->nama_lengkap = $request->nama_lengkap;
        $complaints->telepon = $request->telepon;
        $complaints->email = $request->email;
        $complaints->pengaduan = $request->pengaduan;
        $complaints->status = $request->status;
        $complaints->save();

        return redirect()->route('complaint.index')->with('status', 'Data berhasil diubah');
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
        $kritik = ComplaintCustomer::find($id);
        $kritik->delete();

        return redirect()->route('complaint.index')->with('status', 'Data berhasil dihapus');
    }
}
