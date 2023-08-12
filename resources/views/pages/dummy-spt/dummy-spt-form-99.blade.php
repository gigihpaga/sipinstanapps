<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modal-action-label">Form Tambah PKA & SPT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="form-spt-edit" action={{ route('spt.update', $data->id) }} method="POST">
            @csrf
            {{-- @method('PUT') --}}
            <h4 class="mb-2">SPT</h4>
            <input type="text" value="{{ $data->id }}" hidden name="pka_id" id="pkaid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nomorPengajuan" class="form-label">Nomor Pengajuan</label>
                        {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                        <input type="text" value="{{ $data->nomor_pengajuan }}" placeholder="Nomor Pengajuan"
                            name="nomor_pengajuan" class="form-control" id="nomorPengajuan" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sifatpenugasan" class="form-label">Sifat Tugas</label>
                    <select class="js-example-basic-single form-select " id="sifatpenugasan" name="sifat_penugasan">
                        <option value="PKPT">PKPT</option>
                        <option value="Non-PKPT">Non-PKPT</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lama_penugasan" class="form-label">Lama Penugasan</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Lama Penugasan"
                                aria-label="Lama Penugasan" aria-describedby="basic-addon2"
                                value="{{ $data->lama_penugasan }}" name="lama_penugasan">
                            <span class="input-group-text" id="basic-addon2">hari</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="tanggalmulaispt" class="form-label">Waktu SPT</label>
                        <div class="input-group mb-3 input-daterange datepicker date" data-date-format="dd-mm-yyyy">
                            <div class="col-md-4">
                                <input class="form-control" type="text" id="tanggalmulaispt"
                                    value="{{ $data->tanggal_mulai }}" name="tanggal_mulai" readonly="">
                            </div>

                            <span
                                class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
                            <div class="col-md-4">
                                <input class="form-control" type="text" id="tanggalselesaispt"
                                    value="{{ $data->tanggal_selesai }}" name="tanggal_selesai" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="keperluantugas" class="form-label">Keperluan Tugas</label>
                        <textarea class="form-control" id="keperluantugas" rows="2" name="keperluan_tugas">{{ $data->keperluan_tugas }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="keterangantugas" class="form-label">Keterangan Tugas</label>
                        <textarea class="form-control" id="keterangantugas" rows="2" name="keterangan_tugas">{{ $data->keterangan_tugas }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" rows="4" name="note">{{ $data->note }}</textarea>
                    </div>
                </div>
            </div>

            <br>

    </div>
    <div class="modal-footer">
        {{-- <button class="btn btn-primary" id="prev-btn-modal">Previous</button>
            <button class="btn btn-primary" id="next-btn-modal">Next</button>
            <button class="btn btn-success" onclick="onFinish()">Finish</button>
            <button class="btn btn-secondary" onclick="onCancel()">Cancel</button> --}}
        <button type="submit" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button id="save-spt" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan, lanjut ke SPT" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
            data-bs-original-title="">
            <i class="ti-save"></i>
            &nbsp;Simpan
        </button>
    </div>
    </form>
</div>
