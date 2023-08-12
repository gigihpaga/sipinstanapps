<?php

namespace App\Http\Controllers;

use App\DataTables\DummySptDataTable;
use App\Http\Requests\SptRequest;
use App\Models\Spt;
use Illuminate\Http\Request;

class DummySptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DummySptDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.dummy-spt.dummy-spt-index');
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
    public function edit(Spt $spt)
    {
        //
        $data = $spt;
        // return view('pages.pkaspt.pkaspt-spt-form', compact('data'));
        return view('pages.dummy-spt.dummy-spt-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spt $spt)
    {
        //
        // dd($request->all());
        // dd($request->all());
        $spt->pemohon_spt = $request->pemohon_spt;
        $spt->sifat_tugas = $request->sifat_tugas;
        // $spt->status_buat = $request->status_buat;
        $spt->nomor_pengajuan = $request->nomor_pengajuan;
        $spt->tanggal_mulai = $request->tanggal_mulai;
        $spt->tanggal_selesai = $request->tanggal_selesai;
        $spt->keperluan_tugas = $request->keperluan_tugas;
        $spt->keterangan_tugas = $request->keterangan_tugas;
        $spt->note = $request->note;
        $spt->created_by = $request->created_by;
        $spt->updated_by = $request->updated_by;
        $spt->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
        ]);
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
}
