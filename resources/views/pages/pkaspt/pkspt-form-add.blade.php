<div class="modal-content">
    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}
    <form id="form-action" action="" method="POST">
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
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <h4>PKA</h4>
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
                            <div class="col-md-12">
                                <label for="start_date" class="form-label">Tanggal PKA</label>
                                <div class="input-group mb-3 input-daterange datepicker date"
                                    data-date-format="dd-mm-yyyy">
                                    <input class="form-control" required="" type="text" id="start_date"
                                        name="start_date" value="" readonly="">
                                    <span
                                        class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">sampai</span>
                                    <input class="form-control" required="" type="text" id="end_date"
                                        name="end_date" value="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Sasaran</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Date Picker Range</label>
                                    <div class="input-group mb-3 input-daterange datepicker date"
                                        data-date-format="dd-mm-yyyy">
                                        <input class="form-control" required="" type="text" id="start_date"
                                            name="start_date" value="" readonly="">
                                        <span
                                            class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
                                        <input class="form-control" required="" type="text" id="end_date"
                                            name="end_date" value="" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="formFileSm" class="form-label">Small file input example</label>
                                <input class="form-control" id="formFileSm" type="file">
                            </div>
                        </div>
                        <br>
                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <h3>Step 2 Content</h3>
                        <div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                            survived not only five centuries, but also the leap into electronic typesetting, remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus PageMaker including versions of Lorem Ipsum. </div>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal-footer">
        {{-- <button class="btn btn-primary" id="prev-btn-modal">Previous</button>
        <button class="btn btn-primary" id="next-btn-modal">Next</button>
        <button class="btn btn-success" onclick="onFinish()">Finish</button>
        <button class="btn btn-secondary" onclick="onCancel()">Cancel</button> --}}
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button id="next-btn-modal" type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="Simpan, lanjut ke SPT" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
            data-bs-original-title="">
            <i class="ti-save"></i>
            &nbsp;Simpan
        </button>
    </div>
</div>
