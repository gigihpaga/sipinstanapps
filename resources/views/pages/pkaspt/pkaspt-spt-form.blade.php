<div class="modal-content">
    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}

    {{-- @csrf
            @method($method) --}}
    <div class="modal-header">
        <h5 class="modal-title" id="modal-action-label">Edit SPT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="form-spt-edit" action={{ route('spt.update', $data->id) }} data-sptid="{{ $data->id }}"
            method="POST">
            @csrf
            @method('PATCH')
            <h4 class="mb-2">SPT</h4>
            <input type="text" value="{{ $data->pka_id }}" hidden name="pka_id" id="pkaid">
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
                    <select class="js-example-basic-single form-select " id="sifatpenugasan" name="sifat_tugas">
                        <option value="PKPT">PKPT</option>
                        <option value="Non-PKPT">Non-PKPT</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lama_penugasan" class="form-label">Lama Penugasan</label>
                        <div class="input-group input-group-sm mb-3">
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
                            <div class="col-md-5">
                                <input class="form-control" type="text" id="tanggalmulaispt"
                                    value="{{ $data->tanggal_mulai }}" name="tanggal_mulai" readonly="">
                            </div>

                            <span
                                class="col bg-primary text-light px-3 justify-content-center align-items-center d-flex">sampai</span>
                            <div class="col-md-5">
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
        </form>
        {{-- input dasar --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="mb-1">
                    <h4>Dasar Pengajuan</h4>
                    {{-- <span>haha</span> --}}
                    <hr class="bg-danger border-2 border-top">
                </div>
            </div>
        </div>
        <div class="dt-responsive">
            <table id="tabel_dasar_pengajuan" class="table table-inverse table-hover" width="100%">
                <tbody>
                    {{-- ajax content here --}}
                </tbody>
            </table>
        </div>
        {{-- input dasar --}}
        {{-- anggota --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="mb-1">
                    <h4>Anggota</h4>
                    {{-- <span>haha</span> --}}
                    <hr class="bg-danger border-2 border-top">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tabel_anggota" class="table table-inverse table-hover" width="100%">
                <thead>
                    <tr>
                        <th style="width: 45%"><label for="rincian_anggota">Nama Anggota</label>
                        </th>
                        <th style="width: 25%"><label for="jabatan_tugas">Jabatan Tugas</label></th>
                        <th style="width: 20%"><label for="lama_tugas">Lama Tugas</label></th>
                        <th style="width: 10%"><label for="aksi"></label></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ajax content here --}}
                </tbody>
                <tfoot>
                    {{-- content manipulate by javascript --}}
                </tfoot>
                <div class="table-loading"></div>
            </table>
        </div>
        {{-- anggota --}}
        <br>
    </div>
    <div class="modal-footer">
        {{-- <button class="btn btn-primary" id="prev-btn-modal">Previous</button>
            <button class="btn btn-primary" id="next-btn-modal">Next</button>
            <button class="btn btn-success" onclick="onFinish()">Finish</button>
            <button class="btn btn-secondary" onclick="onCancel()">Cancel</button> --}}
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button id="save-spt" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan, lanjut ke SPT" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
            data-bs-original-title="">
            <i class="ti-save"></i>
            &nbsp;Simpan
        </button>
    </div>
</div>

<template id='template_tabel_loading'>
    {{-- ini untuk tr --}}
    <tr class="tr-loading">
        <td colspan="100">
            <div style="min-height:100px;">
            </div>
        </td>
    </tr>
    {{-- ini untuk loading --}}
    <div class="table-loading-overlay">
        <div class="table-loading-inner">
            <div class="d-flex justify-content-center col-xs-4 col-xs-offset-4">
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<template id='template_tabel_dasar_pengajuan_button_add'>
    <tr id="row_aksi_add" style="" class="p-1">
        <td colspan="3"> <button type="button" class="btn btn-sm btn-primary" style="font-size:10px;">
                <span class="fa fa-plus"></span>
            </button>
        </td>
    </tr>
</template>

<template id='template_tabel_dasar_pengajuan_format_row'>
    <tr>
        <td style="width: 90%;"></td>
        <td style="width: 10%">
            <div class="table-actions">
                <a class="" data-bs-toggle="tooltip" data-bs-original-title="Ubah" href="javascript:;"
                    data-id="" data-idtargetform="">
                    <i class="ti-pencil "></i>
                </a>
                <a class="ml-1" data-bs-toggle="tooltip" data-bs-original-title="Hapus" href="javascript:;"
                    data-id="" data-idtargetform="">
                    <i class="ti-trash"></i>
                </a>
            </div>
        </td>
    </tr>
</template>

<template id='template_tabel_dasar_pengajuan_form'>
    <tr>
        <td style="width: 90%">
            <form id="dasar_pengajuan_form" action="javascript:;" method="POST">
                @csrf
                <input type="hidden" name="dasar_tugas_spt_id" value="">
                <div class="form-group mb-2">
                    <label for="dasar_tugas">Dasar Tugas</label>
                    <input type="text" class="form-control" name="dasar_tugas" id="dasar_tugas" required>
                    <span class="help-block"></span>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"
                    data-aksi="simpanDasarPengajuan">Simpan</button>
                <button type="button" class="btn btn-sm btn-outline-secondary"
                    data-aksi="bataltambah">Batal</button>
            </form>
        </td>
        {{-- <td style="width: 10%">&nbsp;</td> --}}
    </tr>
</template>

<template id='template_tabel_dasar_pengajuan_form_edit'>
    <td style="width: 90%">
        <form class="dasar_pengajuan_form_edit" action="javascript:;" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="dasar_tugas_spt_id" data-id="" value="">
            <div class="form-group mb-2">
                <label for="dasar_tugas">Dasar Tugas</label>
                <input type="text" class="form-control" name="dasar_tugas" id="dasar_tugas" value=""
                    required>
                <span class="help-block"></span>
            </div>
            <button type="submit" class="btn btn-sm btn-primary" data-aksi="ubahDasarPengajuan"
                data-idtargetform="">Simpan</button>
            <button type="button" class="btn btn-sm btn-danger" data-aksi="batalupdate"
                data-idtargetform="">Batal</button>
        </form>
    </td>
    <td style="width: 10%">
        <div class="konten_asli" style="display:none"></div>
    </td>
</template>

{{-- template anggota --}}

<template id='template_tabel_anggota_format_row'>
    <tr data-row="">
        <td style="width: 45%;"></td>
        <td style="width: 25%;"></td>
        <td style="width: 20%;"></td>
        <td style="width: 10%">
            <div class="table-actions">
                <a class="gps-custom-a-primary" data-bs-toggle="tooltip" data-bs-original-title="Ubah"
                    href="javascript:;" data-idanggota="" data-idpegawai="" data-jabatanpenugasan=""
                    data-lamatugas="" data-name="" data-idtargetform="">
                    <i class="ti-pencil "></i>
                </a>
                <a class="gps-custom-a-danger ml-1" data-bs-toggle="tooltip" data-bs-original-title="Hapus"
                    href="javascript:;" data-idanggota="" data-idpegawai="" data-jabatanpenugasan=""
                    data-lamatugas="" data-name="" data-idtargetform="">
                    <i class="ti-trash "></i>
                </a>
            </div>
        </td>
    </tr>
</template>

<template id='template_tabel_anggota_button_add'>
    <tr id="row_aksi_add_anggota" style="" class="p-1">
        <td colspan="4">
            <button type="button" class="btn btn-sm btn-primary" style="font-size:10px;">
                <span class="fa fa-plus"></span>
            </button>
        </td>
    </tr>
</template>

<template id='template_tabel_anggota_form_add'>
    <form id="anggota_form_add" data-idform="" action="javascript:void(0);" method="POST">
        @csrf
    </form>
</template>

<template id='template_tabel_anggota_form_add_input'>
    <tr data-row="" class="input-row">
        <input type="hidden" name="sptid_byanggota" value="">
        <td style="width: 45%">
            <div class="row mb-3">
                <div class="form-group">
                    <label for="pegawai_id" class="form-label">Nama Anggota</label>
                    <select class="cmb_select2 form-control form-select form-select-sm" id="pegawai_id"
                        name="pegawai_id">
                        {{-- render data ajax here --}}
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary" data-aksi="simpanTambahAnggota">
                Simpan</button>
            <button type="button" class="btn btn-sm btn-outline-secondary"
                data-aksi="batalTambahAnggota">Batal</button>
        </td>
        <td style="width: 25%">
            <div class="form-group">
                <label for="jabatan_penugasan" class="form-label">Jabatan Penugasan</label>
                <select class="cmb_select2 form-control form-select form-select-sm" id="jabatan_penugasan"
                    name="jabatan_penugasan">
                    {{-- render data ajax here --}}
                </select>
                <span class="help-block"></span>
            </div>
        </td>
        <td style="width: 20%">
            <div class="form-group form-input form-control-sm">
                <label for="lama_tugas">Lama Tugas</label>
                <input type="number" class="form-control" name="lama_tugas" required>
                <span class="help-block"></span>
            </div>
        </td>
        <td style="width: 10%"></td>

        {{-- <td style="width: 10%">&nbsp;</td> --}}
    </tr>
</template>

<template id="template_tabel_anggota_form_edit">
    <form class="anggota_form_edit" data-idform="" action="javascript:void(0);" method="POST">
        @csrf
        @method('PATCH')
    </form>
</template>

<template id='template_tabel_anggota_form_edit_input'>
    {{-- class anggota_form_edit nanti akan di direplace menjadi anggota_form_edit_randomStringDate() --}}
    <td class="input-td" style="width: 45%">
        <input type="hidden" name="anggota_id" value="">
        <div class="row mb-3">
            <div class="form-group">
                <label for="pegawai" class="form-label">Nama Anggota</label>
                <select class="cmb_select2 form-select form-select-sm" name="pegawai_id">
                    {{-- render data ajax here --}}
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary" data-aksi="updateAnggota">Simpan</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-aksi="batalUpdateAnggota">Batal</button>
    </td>
    <td class="input-td" style="width: 25%">
        <div class="form-group">
            <label for="jabatan_penugasan" class="form-label">Jabatan Penugasan</label>
            <select class="cmb_select2 form-select form-select-sm" name="jabatan_penugasan">
                {{-- render data ajax here --}}
            </select>
            <span class="help-block"></span>
        </div>
    </td>
    <td class="input-td" style="width: 20%">
        <div class="form-group form-input form-control-sm">
            <label for="lama_tugas">Lama Tugas</label>
            <input type="number" class="form-control" name="lama_tugas" required>
            <span class="help-block"></span>
        </div>
    </td>
    <td style="width: 10%">
        <div class="konten_asli" style="display:none"></div>
    </td>
</template>
