<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaRequest;
use App\Models\Anggota;
use App\Models\Spt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AnggotaController extends Controller
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
        $model = Anggota::with('pegawai')->where('spt_id', $spt->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get data successfully',
            'data' => $model,
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
    public function store(AnggotaRequest $request)
    {
        //
        $payload = [
            'spt_id' => $request->sptid_byanggota,
            'pegawai_id' => $request->pegawai_id,
            'lama_tugas' => $request->lama_tugas,
            'jabatan_penugasan' => $request->jabatan_penugasan,
            // 'created_by' => Auth::user()->id,

        ];
        Anggota::create($payload);
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
    public function update(AnggotaRequest $request, $id)
    {
        //
        $this->authorize('read_master/pegawai');
        // === old style ==============================================
        // dd($request->all());
        $model = Anggota::where('id', $id)->firstOrFail();
        $model->pegawai_id = $request->pegawai_id;
        $model->jabatan_penugasan = $request->jabatan_penugasan;
        $model->lama_tugas = $request->lama_tugas;
        $data =  $model->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
            'data' => $data
        ]);
        // === old style ==============================================

        // === new style ==============================================
        // try {
        //     $editFields = ["pegawai_id", "lama_tugas", "jabatan_penugasan"];
        //     // $allowedRoles = auth()->user()->hasRole(["super admin"]);
        //     $query = Anggota::query();
        //     // if (!$allowedRoles) {
        //     //     //check if user is the owner of the record.
        //     //     $query->where("pka.dientri_oleh", auth()->user()->id_user);
        //     // }

        //     // $record = $query->findOrFail($rec_id, Pka::editFields());
        //     $record = $query->findOrFail($id, $editFields);
        //     // dd($record);

        //     // $modeldata = $this->normalizeFormData($request->validated());
        //     // $modeldata = $request->collect()->except('_token', '_method', 'anggota_id')->all();
        //     $modeldata = $request->except('_token', '_method', 'anggota_id');
        //     // $modeldata['upload_pka'] = '$fileInfo['filepath']'; // inject key in array


        //     // if (array_key_exists("upload_pka", $modeldata)) {
        //     //     //move uploaded file from temp directory to destination directory
        //     //     $fileInfo = $this->moveUploadedFiles($modeldata['upload_pka'], "upload_pka");
        //     //     $modeldata['upload_pka'] = $fileInfo['filepath'];
        //     // }

        //     $r = [
        //         "pegawai_id" => $modeldata['pegawai_id'],
        //         "lama_tugas" => $modeldata['lama_tugas'],
        //         "jabatan_penugasan" => $modeldata['jabatan_penugasan']
        //     ];

        //     $data = $record->update($r);
        //     $data2 = Anggota::find($id);

        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Update data successfully',
        //         'data' => $data2
        //     ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => 'success false',
        //         'message' => 'failed Update data successfully',
        //         'data' => $th->getMessage()
        //     ], 500);
        // }

        // === new style ==============================================
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
            $dasarTugas = Anggota::where('id', $id)->firstOrFail();
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
