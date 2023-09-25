<?php

namespace App\Http\Controllers;

use App\Http\Requests\SptRequest;
use App\Http\Requests\SptStatusHistoryRequest;
use App\Models\Anggota;
use App\Models\DasarTugas;
use App\Models\Spt;
use App\Models\SptStatusHistory;
use App\Utilities\MyUtilities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

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

        function updateFilePengajuanSpt($spt_id)
        {
            $modelSptUpdate = Spt::find($spt_id);
            $modelSptUpdate->file_pengajuan_spt = SptController::generateWordSpt($spt_id);
            $modelSptUpdate->save();
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
                 * jika status yang dikirim == 6 (approve), maka update file_pengajuan_spt
                 */

                if ($reqStatus == 6) {
                    updateFilePengajuanSpt($idSpt);
                }

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

    static function generateWordSpt($spt_id)
    {
        try {
            $fileTemplateName = "Template SPT.docx";
            $fileTemplateFolder = "dokumen/spt";
            $fileTemplatePath = public_path("$fileTemplateFolder/$fileTemplateName");

            $enum_jabatan = [1 => 'penanggungjawab', 2 => 'pengawas', 3 => 'ketua tim', 4 => 'anggota'];
            $model_spt = Spt::where('id', $spt_id)->get();
            $model_dasar_tugas = DasarTugas::where('spt_id', '=', $spt_id)->get()->toArray();
            $model_anggota = Anggota::where('spt_id', '=', $spt_id)->with('pegawai')->get()->toArray();
            // dd([$model_spt, $model_dasar_tugas,   $model_anggota]);

            // ================================ Tabel Dasar Tugas [start] ========================================
            $document_with_table2 = new PhpWord();
            $section_dasar = $document_with_table2->addSection();
            $tbl_dasar = $section_dasar->addTable();
            $table_style_dasar = array(
                'borderColor' => 'FFFFFF',
                'borderSize'  => 0,
                'cellMargin'  => 20
            );
            if (count($model_dasar_tugas) > 0) {
                for ($r = 0; $r <= count($model_dasar_tugas) - 1; $r++) {
                    $data_row_dasar = $model_dasar_tugas[$r];
                    $tbl_dasar->addRow();
                    $tbl_dasar->addCell(500, $table_style_dasar)->addText($r + 1);
                    $tbl_dasar->addCell(8500, $table_style_dasar)->addText($data_row_dasar['dasar_tugas']);
                }
            } else {
                $tbl_dasar->addRow();
                $tbl_dasar->addCell(500, $table_style_dasar)->addText(0);
                $tbl_dasar->addCell(8500, $table_style_dasar)->addText('Tidak ada data');
            }
            // Create writer to convert document to xml
            $obj_writer_dasar = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table2, 'Word2007');
            // Get all document xml code
            $full_xml_dasar = $obj_writer_dasar->getWriterPart('Document')->write();
            // Get only table xml code
            $table_xml_dasar = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $full_xml_dasar);

            // ================================ Tabel Dasar Tugas [end] ========================================


            // ================================ Tabel Anggota [start] ========================================
            // Creating the new document...
            // jika ada error edit file php.ini di apache server, set short_open_tag=On
            //Create table
            $document_table_anggota = new PhpWord();
            $section_anggota = $document_table_anggota->addSection();
            $tbl_anggota = $section_anggota->addTable();
            $tbl_style_anggota = array(
                'borderColor' => '00000',
                'borderSize'  => 1,
                'cellMargin'  => 20,
                'align' => 'centered',
                'align' => 'center',
                'alignment' => 'centered',
                'alignment' => 'center'
            );
            $document_table_anggota->addFontStyle('r2Style', array('bold' => false, 'italic' => false, 'size' => 12));
            $document_table_anggota->addParagraphStyle('p2Style', array('align' => 'both', 'spaceAfter' => 100));

            $sss = array('bold' => true, 'align' => 'centered', 'alignment' => 'centered', 'align' => 'both');

            $tbl_anggota->addRow();
            $tbl_anggota->addCell(500, $tbl_style_anggota)->addText('No', $sss);
            $tbl_anggota->addCell(4500, $tbl_style_anggota)->addText('Nama', $sss);
            $tbl_anggota->addCell(1750, $tbl_style_anggota)->addText('Keterangan', $sss);
            $tbl_anggota->addCell(1750, $tbl_style_anggota)->addText('Jangka Waktu', $sss);

            for ($r = 0; $r <= count($model_anggota) - 1; $r++) {
                $data_row_anggota = $model_anggota[$r];
                $tbl_anggota->addRow();
                $tbl_anggota->addCell(500, $tbl_style_anggota)->addText($r + 1);
                $tbl_anggota->addCell(4500, $tbl_style_anggota)->addText($data_row_anggota['pegawai']['nama']);
                $tbl_anggota->addCell(1750, $tbl_style_anggota)->addText($enum_jabatan[$data_row_anggota['jabatan_penugasan']]);
                $tbl_anggota->addCell(1750, $tbl_style_anggota)->addText($data_row_anggota['lama_tugas'] . ' hari');
            }
            // Create writer to convert document to xml
            $obj_writer_anggota = \PhpOffice\PhpWord\IOFactory::createWriter($document_table_anggota, 'Word2007');
            // Get all document xml code
            $full_xml_anggota = $obj_writer_anggota->getWriterPart('Document')->write();
            // Get only table xml code
            $table_xml_anggota = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $full_xml_anggota);

            // ================================ Tabel Anggota [end] ========================================
            $phpWord = new TemplateProcessor($fileTemplatePath);

            // assign value to variable template word
            $phpWord->setValues([
                'nomorPengajuan' => $model_spt->value('nomor_pengajuan'),
                'tanggalBuat' => $model_spt->value('tanggal_buat'),
                'lamaPenugasan' =>  $model_spt->value('lama_penugasan'),
                'lamaPenugasanTerbilang' =>  MyUtilities::terbilang($model_spt->value('lama_penugasan')),
                'tanggalMulai' => MyUtilities::dateMySqlToIndo($model_spt->value('tanggal_mulai')),
                'tanggalSelesai' => MyUtilities::dateMySqlToIndo($model_spt->value('tanggal_selesai')),
                'keperluanTugas' => $model_spt->value('keperluan_tugas'),
                'keteranganTugas' => $model_spt->value('keterangan_tugas'),
                'penandatangan' => $model_spt->value('penyusun'),
                'dateNow' => date('F, Y'),
                'tableDasar' => $table_xml_dasar,
                'tableAnggota'  => $table_xml_anggota,
            ]);

            // EXPORT-PENG-DEV-09-45-NupKA_240923_5247
            $fileExportName = 'EXPORT-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $model_spt->value('nomor_pengajuan')) . '_' . date_format(now(), 'dmy_is');
            // save the document to
            $phpWord->saveAs("$fileTemplateFolder/$fileExportName" . ".docx");

            // return $this->redirect($redirectUrl, "Record exported");
            return $fileExportName . '.docx';
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
