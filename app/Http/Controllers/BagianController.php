<?php

namespace App\Http\Controllers;

use App\DataTables\BagianDataTable;
use App\Http\Requests\BagianRequest;
use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BagianDataTable $dataTable)
    {
        //
        $this->authorize('read_master/bagian');
        return $dataTable->render('pages.bagian.bagian-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('read_master/bagian');
        // return view dan model Role, tanpa membawa data
        return view('pages.bagian.bagian-form', ['data' => new Bagian()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BagianRequest $request)
    {
        //
        // dd($request->all());
        $this->authorize('create_master/bagian');
        Bagian::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function show(Bagian $bagian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function edit(Bagian $bagian)
    {
        //
        $data = $bagian;
        return view('pages.bagian.bagian-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bagian $bagian)
    {
        //
        $bagian->nama = $request->nama;
        $bagian->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian)
    {
        //
        $bagian->delete();
        // dd($bagian);
        // try {
        //     $bagian->delete();
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
