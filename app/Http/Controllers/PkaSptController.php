<?php

namespace App\Http\Controllers;

use App\Http\Requests\PkaRequest;
use App\Models\Pka;
use App\Models\Spt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('pages.pkaspt.pkaspt-form', ['data' => new Pka()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_pka(PkaRequest $request)
    {
        //
        // Pka::create($request->all());
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Create data successfully',
        // ]);
        // Applications::create($request->except('referee_name'));
        // Applications::create($request->except('referee_name', 'referee_email', 'etc', 'etc));
        // except(['referee_name', 'referee_email', 'etc'])

        // $dokumen = $request->file('nama_file_pdf');
        // $nama_dokumen = 'pka-' . date('Ymd-his') . '.' . $request->file('nama_file_pdf')->getClientOriginalExtension();
        // $path = $dokumen->move('dokumen/pka', $nama_dokumen);
        // $request->request->replace(array('nama_file_pdf' => $nama_dokumen));;
        // $pka = Pka::create($request->all());
        // ==============================================================================================
        // add key and value to manipulate request data
        $request->request->add([
            'created_by' => Auth::user()->id,
        ]);
        // formated date yyyy-mm-dd for mysql
        $tanggal_mulai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_mulai)->format('Y-m-d');
        $tanggal_selesai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_selesai)->format('Y-m-d');

        // replace value by key
        $request->merge([
            'tanggal_mulai' => $tanggal_mulai_formated,
            'tanggal_selesai' => $tanggal_selesai_formated
        ]);

        // get file upload user for save to the server
        $file = $request->file('nama_file_pdf');

        // rename file
        $newFileName = 'pka-' . date('Ymd-his') . '.' . $request->file('nama_file_pdf')->getClientOriginalExtension();

        // ========== proses save data to server here ==========
        // location target save path directory save to public\dokumen\pka\{name_file} ... maybe after this use the storage method
        $path = $file->move('dokumen/pka', $newFileName);
        // ========== proses save data to server here ==========

        // dropout original value nama_file_pdf from frontend
        $reqWitoutFile = $request->except(['nama_file_pdf']);

        // insert new file name using old key
        $fixData = array_merge($reqWitoutFile, ['nama_file_pdf' => $newFileName]);

        // save to db
        $pka = Pka::create($fixData);
        // $pka::with('spt')->where('id', 29)->get()
        Spt::create(['pka_id' => $pka->id, 'status_buat' => '0', 'pemohon_spt' => $pka->created_by, 'created_by' => $pka->created_by]);
        $pkaspt = Pka::with('spt')->where('id', $pka->id)->get();


        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
            'data' => $pkaspt,
            // 'path' => $path->getPathname(),
            // 'pka_id' => $pka->id
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_spt(Request $request)
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
