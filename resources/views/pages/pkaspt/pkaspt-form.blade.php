<div class="modal-content">
    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}

    {{-- @csrf
        @method($method) --}}
    <div class="modal-header">
        <h5 class="modal-title" id="modal-action-label">Form Tambah PKA & SPT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div id="smartwizard">
            <ul class="nav nav-progress mt-4">
                <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        <div class="num">1</div>
                        PKA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <span class="num">2</span>
                        SPT
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-pka">
                    <form id="form-pka" action="{{ route('pkaspt.store_pka') }}" method="POST">
                        <h4 class="mb-2">PKA</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pkano" class="form-label">Nomor PKA</label>
                                    {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                                    <input type="text" value="" placeholder="Nomor PKA" name="pka_no"
                                        class="form-control" id="pkano" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaOpd" class="form-label">Nama OPD</label>
                                    {{-- <input type="text" value="{{ $role->guard_name }}" placeholder="Guard name" --}}
                                    <input type="text" value="" placeholder="Nama OPD" name="nama_opd"
                                        class="form-control" id="namaOpd" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{--  --}}
                            {{--  --}}
                            <div class="col-md-12">
                                <label for="tanggal_mulai" class="form-label">Waktu PKA</label>
                                <div class="input-group mb-3 input-daterange datepicker date"
                                    data-date-format="dd-mm-yyyy">
                                    <input class="form-control" required="" type="text" id="tanggal_mulai"
                                        name="tanggal_mulai" value="" readonly="">
                                    <span
                                        class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">sampai</span>
                                    <input class="form-control" required="" type="text" id="end_date"
                                        name="tanggal_selesai" value="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="sasaran" class="form-label">Sasaran</label>
                                    <textarea class="form-control" id="sasaran" rows="4" name="sasaran"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nama_file_pdf " class="form-label">Lampiran</label>
                                <input class="form-control" id="nama_file_pdf" type="file" name="nama_file_pdf">
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-spt">
                    <form id="form-spt" action="{{ route('pkaspt.store_spt') }}" method="POST">
                        <h4 class="mb-2">SPT</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nomor_pengajuan" class="form-label">Nomor Pengajuan</label>
                                    {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                                    <input type="text" value="" placeholder="Nomor Pengajuan"
                                        name="nomor_pengajuan" class="form-control" id="nomor_pengajuan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sifat_penugasan" class="form-label">Sifat Tugas</label>
                                <select class="js-example-basic-single form-select " id="sifat_penugasan"
                                    name="sifat_penugasan">
                                    <option value="PKA">PKA</option>
                                    <option value="Non-PKPT">Non-PKPT</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lama_penugasan" class="form-label">Lama Penugasan</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Lama Penugasan"
                                            aria-label="Lama Penugasan" aria-describedby="basic-addon2"
                                            name="lama_penugasan">
                                        <span class="input-group-text" id="basic-addon2">hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Waktu SPT</label>
                                    <div class="input-group mb-3 input-daterange datepicker date"
                                        data-date-format="dd-mm-yyyy">
                                        <input class="form-control" required="" type="text" id="tanggal_mulai"
                                            name="tanggal_mulai" value="" readonly="">
                                        <span
                                            class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
                                        <input class="form-control" required="" type="text" id="end_date"
                                            name="tanggal_selesai" value="" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="keperluan_tugas" class="form-label">Keperluan Tugas</label>
                                    <textarea class="form-control" id="keperluan_tugas" rows="2" name="keperluan_tugas"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="keterangan_tugas" class="form-label">Keterangan Tugas</label>
                                    <textarea class="form-control" id="keterangan_tugas" rows="2" name="keterangan_tugas"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" id="note" rows="4" name="note"></textarea>
                                </div>
                            </div>
                        </div>

                        <br>
                    </form>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            {{-- <button class="btn btn-primary" id="prev-btn-modal">Previous</button>
        <button class="btn btn-primary" id="next-btn-modal">Next</button>
        <button class="btn btn-success" onclick="onFinish()">Finish</button>
        <button class="btn btn-secondary" onclick="onCancel()">Cancel</button> --}}
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button id="next-btn-modal" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan, lanjut ke SPT" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
                data-bs-original-title="">
                <i class="ti-save"></i>
                &nbsp;Simpan
            </button>
        </div>
    </div>
