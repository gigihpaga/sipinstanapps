<?php

namespace App\Http\Controllers;

use App\Http\Requests\SptRequest;
use App\Models\Spt;
use App\Models\SptStatusHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SptController extends Controller
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
    public function edit(Spt $spt)
    {
        //
        $data = $spt;
        return view('pages.pkaspt.pkaspt-spt-form', compact('data'));
        // return view('pages.spt.spt-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SptRequest $request, Spt $spt)
    {
        //
        $sptId = $spt->id;
        $tanggal_mulai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_mulai)->format('Y-m-d');
        $tanggal_selesai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_selesai)->format('Y-m-d');

        $spt->sifat_tugas = $request->sifat_tugas;
        $spt->status_buat = '1'; // status_buat = 1. 'Selesai'
        $spt->nomor_pengajuan = $request->nomor_pengajuan;
        $spt->lama_penugasan = $request->lama_penugasan;
        $spt->tanggal_mulai = $tanggal_mulai_formated;
        $spt->tanggal_selesai = $tanggal_selesai_formated;
        $spt->keperluan_tugas = $request->keperluan_tugas;
        $spt->keterangan_tugas = $request->keterangan_tugas;
        $spt->note = $request->note;
        $spt->save();
        if ($spt) {
            $dataHistory = SptStatusHistory::where('spt_id', $sptId)->get();
            if ($dataHistory->count() > 0) {
                SptStatusHistory::create(['spt_id' => $sptId, 'status' => '3', 'status_dilihat' => 'N', 'created_by' => Auth::user()->id]);
            } else {
                SptStatusHistory::create(['spt_id' => $sptId, 'status' => '1', 'status_dilihat' => 'N', 'created_by' => Auth::user()->id]);
            }
        }

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
    public function destroy($id)
    {
        //
    }
}
