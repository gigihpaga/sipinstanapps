<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    // test middleware di controller start
    // public function __construct()
    // {
    //     $this->middleware('can:create permission')->only('create');
    // }
    // test middleware di controller end

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // // test role start
        // if ($request->user()->hasRole('admin')) {
        //     return 'hallo ' . $request->user()->name . ' anda mempunya akses ke halaman roles index';
        // }
        // abort(403);
        // // test role end

        // // test permission menggunakan gate start
        // if (!Gate::allows('read permmison')) {
        //     abort(403, 'unauthorized');
        // }
        // return 'hallo ' . $request->user()->name . ' anda mempunya akses ke halaman roles index';
        // // test permission menggunakan gate end

        // test permission menggunakan authorize start
        $this->authorize('read permission');
        // return 'hallo ' . $request->user()->name . ' anda mempunya akses ke halaman roles index';
        return view('pages.role.roles-index');
        // test permission menggunakan authorize end

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return 'hallo ' . $request->user()->name . ' anda mempunya akses ke halaman roles create';
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
