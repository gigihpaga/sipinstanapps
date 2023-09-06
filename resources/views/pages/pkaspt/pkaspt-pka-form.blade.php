<div class="modal-content">
    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}

    {{-- @csrf
            @method($method) --}}
    <div class="modal-header">
        <h5 class="modal-title" id="modal-action-label">Edit PKA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="form-pka-edit" action="{{ route('pkaspt.pka.update', $data->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <h4 class="mb-2">PKA</h4>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pkano" class="form-label">Nomor PKA</label>
                        {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                        <input type="text" value="{{ $data->pka_no }}" placeholder="Nomor PKA" name="pka_no"
                            class="form-control" id="pkano" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaOpd" class="form-label">Nama OPD</label>
                        {{-- <input type="text" value="{{ $role->guard_name }}" placeholder="Guard name" --}}
                        <input type="text" value="{{ $data->nama_opd }}" placeholder="Nama OPD" name="nama_opd"
                            class="form-control" id="namaOpd" required>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tanggalmulaipka" class="form-label">Waktu PKA</label>
                        <div class="input-group input-daterange datepicker date" data-date-format="dd-mm-yyyy">
                            <div class="col-md-5">
                                <input class="form-control" type="text" id="tanggalmulaipka"
                                    value="{{ $data->tanggal_mulai }}" name="tanggal_mulai" readonly="">
                            </div>

                            <span
                                class="col bg-primary text-light px-3 justify-content-center align-items-center d-flex">sampai</span>
                            <div class="col-md-5">
                                <input class="form-control" type="text" id="tanggalselesaipka"
                                    value="{{ $data->tanggal_selesai }}" name="tanggal_selesai" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="4" name="keterangan">{{ $data->keterangan }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ $data->alamat }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_file_pdf" class="form-label">Ubah Lampiran</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control" id="nama_file_pdf" type="file" name="nama_file_pdf"
                                accept="application/pdf" aria-label="Upload">
                            <a id="btn_file_upload_view"
                                class="btn d-none justify-content-center align-items-center btn-outline-secondary"
                                href="" data-bs-toggle="tooltip" title="">
                                <i class="ti-eye"></i>
                            </a>
                            <button id="btn_file_upload_cancel" class="btn d-none btn-outline-danger" type="button">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label">Lampiran PDF yang telah di upload</label>
                    <div class="form-group">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a id="btn_view_lampiran" class="btn mb-2 btn-outline-primary"
                                href="{{ route('pkaspt.pka.filepdf', $data->id) }}" target="_blank"
                                data-bs-toggle="tooltip" title="{{ $data->nama_file_pdf }}">
                                <i class="ti-download"></i>
                            </a>
                            <a id="btn_view_lampiran_modal"
                                href="{{ route('pkaspt.pka.filepdf', $data->id) }}?encode=yes"
                                class="btn mb-2 icon-left btn-outline-primary" data-bs-toggle="tooltip"
                                title="{{ $data->nama_file_pdf }}">
                                <i class="ti-zip"></i>
                                View
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{--  --}}
            <div class="row mb-2" style="display: none;" data-discription="element-percobaan-read-pdf-blob">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="input_test_base64_to_file" class="form-label">Base64 to File</label>
                        <div class="input-group input-group-sm">
                            <span id="btn_test_base64_to_file"
                                class="btn btn-info input-group-addon d-flex justify-content-center align-items-center"
                                data-bs-toggle="tooltip" title="Generate base64 to File">
                                <i class="ti-id-badge"></i>
                            </span>
                            <span id="btn_test_request_file_server"
                                class="btn btn-success input-group-addon d-flex justify-content-center align-items-center"
                                data-bs-toggle="tooltip"
                                title="Request file <{{ $data->nama_file_pdf }}> to server, using [id_pka]">
                                <i class="ti-archive"></i>
                            </span>
                            <textarea class="form-control" rows="3" id="input_test_base64_to_file" name="input_test_base64_to_file"
                                aria-describedby="btn_base64_to_file" aria-label="With textarea" {{-- style="resize:none"  --}}></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button id="update-pka" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan Perubahan" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
            data-bs-original-title="">
            <i class="ti-save"></i>
            &nbsp;Simpan
        </button>
    </div>
</div>
