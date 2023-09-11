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
// use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;

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
            ->addColumn('control_collapse', function ($row) {
                return view('pages.pkaspt.pkaspt-button-control-collapse')->with(['data' => $row]);
            })
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
    public function edit(Pka $pka)
    {
        //
        $data = $pka;
        return view('pages.pkaspt.pkaspt-pka-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PkaRequest $request, $id)
    {
        //
        $model = Pka::where('id', $id)->firstOrFail();
        $oldFileName = $model->nama_file_pdf;
        $oldFilePath = public_path('dokumen\\pka\\' . $oldFileName);

        /** Handle file from client to upload
         * 1. get file upload user for save to the server
         * 2. rename file
         * 3. move file (representing upload file).
         * in PHP, upload file is moved file from temporary folder on client user to the location target path directory on server
         * eg:  from (C:\Users\PAGA\AppData\Local\Temp) move to directory (public\dokumen\pka\{name_file}...)
         */
        $file = $request->file('nama_file_pdf');
        $newFileName = 'pka-' . date('Ymd-his') . '.' . $request->file('nama_file_pdf')->getClientOriginalExtension();
        $newFile = $file->move('dokumen/pka', $newFileName);
        $newFilePath = public_path('dokumen\\pka\\' . $newFile->getBasename());

        // if successfully upload, delete oldFile
        if (file_exists($newFilePath)) {
            // check oldFile exist
            if (file_exists($oldFilePath)) {
                // delete oldFile
                unlink($oldFilePath);
            }
        }

        $tanggal_mulai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_mulai)->format('Y-m-d');
        $tanggal_selesai_formated = Carbon::createFromFormat('d-m-Y', $request->tanggal_selesai)->format('Y-m-d');

        $model->pka_no = $request->pka_no;
        $model->nama_opd = $request->nama_opd;
        $model->tanggal_mulai = $tanggal_mulai_formated;
        $model->tanggal_selesai = $tanggal_selesai_formated;
        $model->keterangan = $request->keterangan;
        $model->alamat = $request->alamat;
        $model->nama_file_pdf = $newFileName;
        $model->updated_by = Auth::user()->id;
        $data = $model->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully',
            'data' => $data
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

    /**
     * Show pdf file,
     * Return the raw contents of a binary file (foo.pdf) ***OR*** base64_encode() representing of binary file.
     *
     * @param  int  $id
     * @return base64_encode($fileBinnary)
     * @return response()->file($filePath) || response($fileBinnary)
     */
    public function filePdf($id)
    {
        $model = Pka::where('id', $id)->firstOrFail();
        $namaFile = $model->nama_file_pdf;

        $filePath = public_path('dokumen\\pka\\' . $namaFile);      // Path to the file OR directory. eg: C:\Users\PAGA\Documents\Coba PHP Laravel\sipinstanapps\public\dokumen\pka\pka-20230903-032653.pdf. the on windows the separator using "\\" OR "/"
        $fileIsExist = file_exists($filePath);

        // check file is exist
        if (!$fileIsExist) {
            return abort(404);
        }

        $fileBinnary = file_get_contents($filePath);
        $informationFile = pathinfo($filePath);
        // $mungkinArrayBuffer = file($filePath);

        $mimeContentType = mime_content_type($filePath);                // return "application/pdf"
        $fileSize = filesize($filePath);                                // 1231233 bit
        $extension = $informationFile['extension'];                     // pdf
        $orginalNameWithExtention = $informationFile['basename'];       // pka-20230902-015509.pdf
        $orginalNameWithOutExtention = $informationFile['filename'];    // pka-20230902-015509


        $fileMeta = [
            'mimeContentType' => $mimeContentType,
            'fileSize' => $fileSize,
            'extension' => $extension,
            'orginalNameWithExtention' => $orginalNameWithExtention,
            'orginalNameWithOutExtention' => $orginalNameWithOutExtention,
            'dirname' =>  $filePath,
        ];

        // optional parameter to encode file
        if (request()->encode && request()->encode == "yes") {
            return response(base64_encode($fileBinnary)) // jika ingin mereturn sebagai base64
                ->header('Cache-Control', 'no-cache private')
                ->header('Content-Description', 'File Transfer')
                ->header('Content-Location', '/dokumen/pka/' . $fileMeta['orginalNameWithExtention'])
                // ->header('Content-Type', 'application/pdf')
                // ->header('Content-Type', 'text/plain; charset=ISO-8859-1') // jika ingin mereturn sebagai base64
                ->header('Content-Type', 'text/plain; charset=UTF-8') // jika ingin mereturn sebagai base64
                ->header('Content-length', $fileMeta['fileSize'])
                ->header('Content-Disposition', 'inline; filename="' .  $fileMeta['orginalNameWithOutExtention'] . '"') // biar idm tidak langsung download, jangan memberikan extention pada filename
                // ->header('Content-Transfer-Encoding', 'binary');
                // ->header('Content-Transfer-Encoding', 'base64');
                // ->header('Content-Encoding', 'base64');
                ->header('Transfer-Encoding', 'base64'); // jika ingin mereturn sebagai base64 (HARUS MENGGUNAKAN INI, JIKA TIDAK, base64_encode DARI PHP AKAN DI UBAH OLEH HTTP)

        }

        // file not encode
        return response($fileBinnary)
            // return response(base64_encode($fileBinnary)) // jika ingin mereturn sebagai base64
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Location', '/dokumen/pka/' . $fileMeta['orginalNameWithExtention'])
            ->header('Content-Type', 'application/pdf')
            // ->header('Content-Type', 'text/plain; charset=ISO-8859-1') // jika ingin mereturn sebagai base64
            ->header('Content-length', $fileMeta['fileSize'])
            ->header('Content-Disposition', 'attachment; filename=' .  $fileMeta['orginalNameWithExtention']) // biar idm tidak langsung download, jangan memberikan extention pada filename
            // ->header('Content-Transfer-Encoding', 'base64'); // jika ingin mereturn sebagai base64
            ->header('Content-Transfer-Encoding', 'binary');
    }

    // tidak ada button untuk ke controller ini, hanya bisa langsung di panggil via url
    public function viewPdf_test($id)
    {
        echo "testing pdf";
        die();
        $model = Pka::where('id', $id)->firstOrFail();
        $namaFile = $model->nama_file_pdf;
        $filePath = public_path('dokumen/pka/' . $namaFile);      // C:\Users\PAGA\Documents\Coba PHP Laravel\sipinstanapps\public\dokumen/pka/pka-20230903-032653.pdf
        $fileBinnary = file_get_contents($filePath);
        $informationFile = pathinfo($filePath);
        $mungkinArrayBuffer = file($filePath);

        $mimeContentType = mime_content_type($filePath);                // return "application/pdf"
        $fileSize = filesize($filePath);                                // 1231233 bit
        $extension = $informationFile['extension'];                     // pdf
        $orginalNameWithExtention = $informationFile['basename'];       // pka-20230902-015509.pdf
        $orginalNameWithOutExtention = $informationFile['filename'];    // pka-20230902-015509


        $fileMeta = [
            'mimeContentType' => $mimeContentType,
            'fileSize' => $fileSize,
            'extension' => $extension,
            'orginalNameWithExtention' => $orginalNameWithExtention,
            'orginalNameWithOutExtention' => $orginalNameWithOutExtention,
            'dirname' =>  $filePath,
        ];

        // return $fileBinnary;
        // return response()->file($file, [
        //     'Cache-Control' => 'no-cache private',
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="' . $namaFile . '"'
        // ]);
        // 'Content-Type' => 'application/octet-stream', // langsung download
        $head = [
            'Cache-Control' => 'no-cache, private',
            'Content-Type' => 'application/pdf',
            'Content-Transfer-Encoding' => 'binary',
            'Content-length' => $fileMeta['fileSize']
        ];
        // return $res = response()->file($filePath, $head);
        $data = [
            'nama' => 'paga',
            'fileBinnary' => $fileBinnary,
            'base64' => base64_encode($fileBinnary),
            'decode64' => base64_decode(base64_encode($fileBinnary)),
            'fileMeta' => $fileMeta
        ];
        // dd($data['base64']);
        return response(base64_encode($fileBinnary)) // jika ingin mereturn sebagai base64
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Location', '/dokumen/pka/' . $fileMeta['orginalNameWithExtention'])
            // ->header('Content-Type', 'application/pdf')
            // ->header('Content-Type', 'text/plain; charset=ISO-8859-1') // jika ingin mereturn sebagai base64
            ->header('Content-Type', 'text/plain; charset=UTF-8') // jika ingin mereturn sebagai base64
            ->header('Content-length', $fileMeta['fileSize'])
            ->header('Content-Disposition', 'inline; filename="' .  $fileMeta['orginalNameWithOutExtention'] . '"') // biar idm tidak langsung download, jangan memberikan extention pada filename
            // ->header('Content-Transfer-Encoding', 'binary');
            // ->header('Content-Transfer-Encoding', 'base64');
            // ->header('Content-Encoding', 'base64');
            ->header('Transfer-Encoding', 'base64'); // jika ingin mereturn sebagai base64 (HARUS MENGGUNAKAN INI, JIKA TIDAK, base64_encode DARI PHP AKAN DI UBAH OLEH HTTP)
    }

    // tidak ada button dan route untuk ke controller ini
    public function pdf($id)
    {
        echo "testing pdf 2";
        die();
        $model = Pka::where('id', $id)->firstOrFail();
        $namaFile = $model->nama_file_pdf;
        $file = public_path('dokumen/pka/' . $namaFile);

        $fileT = filetype($file); // return "file"
        $mimeT = mime_content_type($file); // return "application/pdf"
        $fileZ = filesize($file);
        $infoPath = pathinfo($file);
        /**
         * array:4 [▼ // app\Http\Controllers\PkaSptController.php:175
         * "dirname" => "C:\Users\PAGA\Documents\Coba PHP Laravel\sipinstanapps\public\dokumen/pka"
         * "basename" => "pka-20230902-015931.pdf"
         * "extension" => "pdf"
         * "filename" => "pka-20230902-015931"
         * ]
         * $extension = $infoPath['extension'];
         */


        $file_contents = base64_decode($file, true);
        // $file = file($file);
        // $contents = Storage::get($file);

        // dd($file_contents);
        // $file = Storage::public();


        return response()->file($file, ['yuhu' => 'yuhu']);
        return response()->download($file, 'yeha');
        return response($file_contents)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', $mimeT)
            ->header('Content-length', $fileZ)
            ->header('Content-Disposition', 'attachment; filename=' . $infoPath['filename'])
            ->header('Content-Transfer-Encoding', 'binary');
        return $file_contents;
        return response()->download($file, $infoPath['basename'], [], 'inline');

        // return Response::make(file_get_contents($filePath), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="' . $namaFile . '"'
        // ]);
    }
}
