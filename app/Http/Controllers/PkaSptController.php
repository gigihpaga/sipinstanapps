<?php

namespace App\Http\Controllers;

use App\Models\Pka;
use App\Models\Spt;
use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;

use Yajra\DataTables\Facades\DataTables;

class PkaSptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.pkaspt.pkaspt-index');
    }

    public function loadData()
    {
        $model = Spt::with('user')->with('lastStatusHistory')->get();
        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('pages.pkaspt.pkaspt-button')->with(['data' => $row]);
            })
            ->addColumn('pka', function ($row) {
                return view('pages.pkaspt.pkaspt-button-pka')->with(['data' => $row]);
            })
            ->make(true);
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
