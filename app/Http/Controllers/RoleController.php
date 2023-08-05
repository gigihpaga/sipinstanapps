<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
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
    public function index(RoleDataTable $dataTable)
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
        $this->authorize('read_konfigurasi/roles');
        // return 'hallo ' . $request->user()->name . ' anda mempunya akses ke halaman roles index';
        // return view('pages.role.roles-index');
        return $dataTable->render('pages.role.roles-index');
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
        $this->authorize('create_konfigurasi/roles');
        // return view dan model Role, tanpa membawa data
        return view('pages.role.role-form', ['role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //
        Role::create($request->all());

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
    public function edit(Role $role)
    {
        //
        return view('pages.role.role-form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        //
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();

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
    public function destroy(Role $role)
    {
        //
        try {
            $role->delete();
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
