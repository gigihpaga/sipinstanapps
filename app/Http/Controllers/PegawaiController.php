<?php

namespace App\Http\Controllers;

use App\DataTables\PegawaiDataTable;
use App\Http\Requests\PegawaiRequest;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PegawaiDataTable $dataTable)
    {
        //
        $this->authorize('read_master/pegawai');
        // $pegawai =   Pegawai::join('jabatan', 'jabatan.id', '=', 'pegawai.jabatan_id')
        //     ->join('pangkat_golongan', 'pangkat_golongan.id', '=', 'pegawai.pangkat_golongan_id')
        //     ->join('kelas_perjadin', 'kelas_perjadin.id', '=', 'pegawai.kelas_perjadin_id')
        //     ->select([
        //         'pegawai.*',
        //         'jabatan.nama as jabatan_nama',
        //         'pangkat_golongan.nama as pangkat_golongan_nama',
        //         'kelas_perjadin.kategori as kelas_perjadin_kategori'
        //     ])->get();
        // dd($pegawai);
        return $dataTable->render('pages.pegawai.pegawai-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('read_master/pegawai');
        // return view dan model Role, tanpa membawa data
        $jabatan = Jabatan::get();
        return view('pages.pegawai.pegawai-form', ['data' => new Pegawai(), 'jabatan' => $jabatan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        //
        $this->authorize('create_master/pegawai');
        Pegawai::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
