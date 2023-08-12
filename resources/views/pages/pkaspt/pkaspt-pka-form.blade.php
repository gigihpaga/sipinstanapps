<div class="modal-content">
    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}

    {{-- @csrf
            @method($method) --}}
    <div class="modal-header">
        <h5 class="modal-title" id="modal-action-label">Edit PKA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="form-pka" action="{{ route('pkaspt.pka.update', $data->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <h4 class="mb-2">PKA</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pkano" class="form-label">Nomor PKA</label>
                        {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                        <input type="text" value="{{ $data->pka_no }}" placeholder="Nomor PKA" name="pka_no"
                            class="form-control" id="pkano" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="namaOpd" class="form-label">Nama OPD</label>
                        {{-- <input type="text" value="{{ $role->guard_name }}" placeholder="Guard name" --}}
                        <input type="text" value="{{ $data->nama_opd }}" placeholder="Nama OPD" name="nama_opd"
                            class="form-control" id="namaOpd" required>
                    </div>
                </div>
            </div>
            <div class="row">
                {{--  --}}
                {{--  --}}
                <div class="col-md-12">
                    <label for="tanggalmulaipka" class="form-label">Waktu PKA</label>
                    <div class="input-group mb-3 input-daterange datepicker date" data-date-format="dd-mm-yyyy">
                        <div class="col-md-5">
                            <input class="form-control" required="" type="text" id="tanggalmulaipka"
                                name="tanggal_mulai" value="" readonly="" value="{{ $data->tanggal_mulai }}">
                        </div>
                        <div class="col-md-1 d-inline-block px-1 mt-2">
                            <span
                                class="bg-primary text-light  justify-content-center align-items-center d-inline-block ">sampai</span>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" required="" type="text" id="tanggalselesaipka"
                                name="tanggal_selesai" value="" readonly=""
                                value="{{ $data->tanggal_selesai }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="sasaran" class="form-label">Sasaran</label>
                        <textarea class="form-control" id="sasaran" rows="4" name="sasaran">{{ $data->sasaran }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ $data->alamat }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{-- <button type="button" class="btn mb-2 icon-left btn-outline-danger"><i
                            class="ti-zip"></i>PDF</button> --}}
                    <a class="btn mb-2 icon-left btn-outline-danger" href="/dokumen/pka/{{ $data->nama_file_pdf }}">
                        <i class="ti-zip"></i>pdf</a>
                </div>
            </div>
            <br>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button id="save-pka" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
            data-bs-original-title="">
            <i class="ti-save"></i>
            &nbsp;Simpan
        </button>
    </div>
</div>
