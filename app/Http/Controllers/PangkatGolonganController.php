<?php

namespace App\Http\Controllers;

use App\DataTables\PangkatGolonganDataTable;
use App\Http\Requests\PangkatGolonganRequest;
use App\Models\PangkatGolongan;
use Illuminate\Http\Request;

class PangkatGolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PangkatGolonganDataTable $dataTable)
    {
        //
        $this->authorize('read_master/pangkat_golongan');
        return $dataTable->render('pages.pangkat_golongan.pangkat_golongan-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('read_master/pangkat_golongan');
        // return view dan model Role, tanpa membawa data
        return view('pages.pangkat_golongan.pangkat_golongan-form', ['data' => new PangkatGolongan()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PangkatGolonganRequest $request)
    {
        //
        // dd($request->all());
        $this->authorize('create_master/pangkat_golongan');
        PangkatGolongan::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PangkatGolongan  $pangkat_golongan
     * @return \Illuminate\Http\Response
     */
    public function show(PangkatGolongan $pangkat_golongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PangkatGolongan  $pangkat_golongan
     * @return \Illuminate\Http\Response
     */
    public function edit(PangkatGolongan $pangkat_golongan)
    {
        //
        $data = $pangkat_golongan;
        return view('pages.pangkat_golongan.pangkat_golongan-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PangkatGolongan  $pangkat_golongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PangkatGolongan $pangkat_golongan)
    {
        //
        $pangkat_golongan->nama = $request->nama;
        $pangkat_golongan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PangkatGolongan  $pangkat_golongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PangkatGolongan $pangkat_golongan)
    {
        //
        $pangkat_golongan->delete();
        // dd($pangkat_golongan);
        try {
            $pangkat_golongan->delete();
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
