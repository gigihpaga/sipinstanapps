<?php

namespace App\Http\Controllers;

use App\DataTables\JabatanDataTable;
use App\Http\Requests\JabatanRequest;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JabatanDataTable $dataTable)
    {
        //
        $this->authorize('read_master/jabatan');
        return $dataTable->render('pages.jabatan.jabatan-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('read_master/jabatan');
        // return view dan model Role, tanpa membawa data
        return view('pages.jabatan.jabatan-form', ['data' => new Jabatan()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JabatanRequest $request)
    {
        //
        // dd($request->all());
        $this->authorize('create_master/jabatan');
        Jabatan::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
        $data = $jabatan;
        return view('pages.jabatan.jabatan-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
        $jabatan->nama = $request->nama;
        $jabatan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
        $jabatan->delete();
        // dd($jabatan);
        // try {
        //     $jabatan->delete();
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
