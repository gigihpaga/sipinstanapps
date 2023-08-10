<?php

namespace App\Http\Controllers;

use App\DataTables\KelasPerjadinDataTable;
use App\Http\Requests\KelasPerjadinRequest;
use App\Models\KelasPerjadin;
use Illuminate\Http\Request;

class KelasPerjadinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KelasPerjadinDataTable $dataTable)
    {
        //
        $this->authorize('read_master/kelas_perjadin');
        return $dataTable->render('pages.kelas_perjadin.kelas_perjadin-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('read_master/kelas_perjadin');
        // return view dan model Role, tanpa membawa data
        return view('pages.kelas_perjadin.kelas_perjadin-form', ['data' => new KelasPerjadin()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasPerjadinRequest $request)
    {
        //
        // dd($request->all());
        $this->authorize('create_master/kelas_perjadin');
        KelasPerjadin::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelasPerjadin  $kelas_perjadin
     * @return \Illuminate\Http\Response
     */
    public function show(KelasPerjadin $kelas_perjadin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelasPerjadin  $kelas_perjadin
     * @return \Illuminate\Http\Response
     */
    public function edit(KelasPerjadin $kelas_perjadin)
    {
        // dd($kelas_perjadin);
        //
        $data = $kelas_perjadin;
        return view('pages.kelas_perjadin.kelas_perjadin-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelasPerjadin  $kelas_perjadin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelasPerjadin $kelas_perjadin)
    {
        //
        $kelas_perjadin->kategori = $request->kategori;
        $kelas_perjadin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelasPerjadin  $kelas_perjadin
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelasPerjadin $kelas_perjadin)
    {
        //
        $kelas_perjadin->delete();
        // dd($kelas_perjadin);
        // try {
        //     $kelas_perjadin->delete();
        //     // response
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Delete data successfully',
        //     ]);
        // } catch (\Throwable  $th) {
        //     return response()->json([
        //         'status' => 'failed',
        //         'message' => 'Sorry server down',
        //         // 'message' => $th->getMessage(),
        //     ], 500);
        // }
    }
}
