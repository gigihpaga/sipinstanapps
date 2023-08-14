<?php

namespace App\Http\Controllers;

use App\DataTables\PegawaiDataTable;
use App\Http\Requests\PegawaiRequest;
use App\Models\Jabatan;
use App\Models\KelasPerjadin;
use App\Models\PangkatGolongan;
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
        $pangkatGolongan = PangkatGolongan::get();
        $kelasPerjadin = KelasPerjadin::get();
        return view(
            'pages.pegawai.pegawai-form',
            [
                'data' => new Pegawai(),
                'jabatan' => $jabatan,
                'pangkat_golongan' => $pangkatGolongan,
                'kelas_perjadin' => $kelasPerjadin
            ]
        );
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
        $data = $pegawai;
        $jabatan = Jabatan::get();
        $pangkatGolongan = PangkatGolongan::get();
        $kelasPerjadin = KelasPerjadin::get();
        return view(
            'pages.pegawai.pegawai-form',
            [
                'data' => $data,
                'jabatan' => $jabatan,
                'pangkat_golongan' => $pangkatGolongan,
                'kelas_perjadin' => $kelasPerjadin
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        //
        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->jabatan_id = $request->jabatan_id;
        $pegawai->pangkat_golongan_id = $request->pangkat_golongan_id;
        $pegawai->kelas_perjadin_id = $request->kelas_perjadin_id;
        $data =  $pegawai->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
            'data' => $data
        ]);
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
        try {
            $pegawai->delete();
            // response
            return response()->json([
                'status' => 'success',
                'message' => 'Delete data successfully',
            ]);
        } catch (\Throwable  $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry server down',
                // 'message' => $th->getMessage(),
            ], 500);
        }
    }
}
