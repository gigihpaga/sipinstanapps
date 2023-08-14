<?php

namespace App\Http\Controllers;

use App\Models\DasarTugas;
use App\Models\Spt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasarTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function loadDataBySpt(Spt $spt)
    {
        // $dasartugas =  $spt->with('dasarTugas')->where('id', $spt->id)->get();
        $dasartugas = DasarTugas::where('spt_id', $spt->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get data successfully',
            'data' => $dasartugas,
        ]);
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
        // dd($request->all());
        $dasarTugas = [
            'spt_id' => $request->dasar_tugas_spt_id,
            'dasar_tugas' => $request->dasar_tugas,
            'created_by' => Auth::user()->id,

        ];
        DasarTugas::create($dasarTugas);
        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
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
        //
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
        //

        $dasarTugas = DasarTugas::where('id', $id)->firstOrFail();
        $dasarTugas->dasar_tugas = $request->dasar_tugas;
        $data =  $dasarTugas->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
            'data' => $data
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
        try {
            $dasarTugas = DasarTugas::where('id', $id)->firstOrFail();
            $data =   $dasarTugas->delete();
            // response
            return response()->json([
                'status' => 'success',
                'message' => 'Delete data successfully',
                "data" => $data,
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
