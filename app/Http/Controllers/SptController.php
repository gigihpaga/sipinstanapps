<?php

namespace App\Http\Controllers;

use App\Http\Requests\SptRequest;
use App\Http\Requests\SptStatusHistoryRequest;
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
     * Update (actual is create) status status history spt.
     *
     * @param  \Illuminate\Http\SptStatusHistoryRequest  $request
     * @param  int  $idSpt
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(SptStatusHistoryRequest $request, $idSpt)
    {
        $reqStatus = $request->status;
        $reqKeterangan = $request->keterangan;

        $modelSpt = Spt::where('id', $idSpt)->with('lastStatusHistory')->get();
        $arrSpt = null;
        $arrLastStatusHistory = null;

        function createHistory($spt_id, $history_status, $keterangan)
        {
            $dataHistoryCreated = SptStatusHistory::create(['spt_id' => $spt_id, 'status' => $history_status, 'keterangan' => $keterangan, 'status_dilihat' => 'N', 'created_by' => Auth::user()->id]);
            return $dataHistoryCreated;
        }

        // check model spt is available
        if ($modelSpt->count() == 0) {
            return response()->failedJson(404);
        } else {
            /** get time execute code */
            // $start = microtime(true);
            // $end =  microtime(true);
            // echo "Time: " . ($end - $start) . " s\n";

            /** access eloquent value */
            // $modelSpt->value('id')
            // $modelSpt->toArray()[0]['id'];
            // $modelSpt->load('lastStatusHistory')->toArray();
            // $modelSpt->toArray()[0]['last_status_history'];
            $arrSpt = $modelSpt->toArray()[0];

            // check history spt is available ?? isNot return null
            $arrLastStatusHistory = $arrSpt['last_status_history'] ?? null;
        }

        // check last status sesuai dengan logic bisnis
        if ($arrSpt == null || $arrLastStatusHistory == null) {
            return response()->failedJson(400);
        } elseif ($arrLastStatusHistory['status'] == 1 || $arrLastStatusHistory['status'] == 3) {
            if ($reqStatus == 2 || $reqStatus == 4) {
                /**
                 * status 1: created || 3:updated,
                 * hanya bisa diganti ke status 2: revision || 3: updated** || 4: verified
                 * hanya bisa diganti ke 3: updated** menggunakan function update() yang ada di atas function ini, itu pun tidak menambah history perubahan spt
                 * selain itu return BAD REQUST
                 */
                $historyCreated = createHistory($arrSpt['id'], $reqStatus, $reqKeterangan);
                return response()->successJson($historyCreated, 'update data');
            }
            return response()->failedJson(400);
        } elseif ($arrLastStatusHistory['status'] == 2 || $arrLastStatusHistory['status'] == 4) {
            if ($reqStatus == 5 || $reqStatus == 6) {
                /**
                 * 2: revision || 4: verified
                 * hanya bisa diganti ke status 3: updated** || 5: rejected || 6: approved
                 * hanya bisa diganti ke 3: updated** menggunakan function update() yang ada di atas function ini, itu pun tidak menambah history perubahan spt
                 * selain itu return BAD REQUST
                 */
                $historyCreated = createHistory($arrSpt['id'], $reqStatus, $reqKeterangan);
                return response()->successJson($historyCreated, 'update data');
            }
            return response()->failedJson(400);
        } else {
            /**
             * $arrLastStatusHistory['status'] == 5 || $arrLastStatusHistory['status'] == 6
             * bad request, status 5 hanya bisa diganti jika user memperbarui spt dengan menggunakan function update() line:80
             * bad request, status 6 sudah tidak bisa di update, karena transaksi sudah di anggap selesai
             * selain itu juga bad request return
             */
            return response()->failedJson(400);
        }
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
