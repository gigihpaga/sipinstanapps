@php
    if ($data->id) {
        $action = route('pangkat_golongan.update', $data->id);
        $method = 'PUT';
        $titleButton = 'Save Change';
    } else {
        $action = route('pangkat_golongan.store');
        $method = 'POST';
        $titleButton = 'Save';
    }
@endphp

<div class="modal-content">
    <form id="form-action" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Tambah/Ubah Pangkat Golongan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Nama Pangkat Golongan</label>
                        <input type="text" value="{{ $data->nama }}" placeholder="Masukkan Nama Pangkat Golongan..." name="nama"
                            class="form-control" id="roleName" required>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="mb-3">
                        <label for="guardName" class="form-label">Guard</label>
                        <input type="text" value="{{ $data->guard_name }}" placeholder="Guard name" name="guard_name"
                            class="form-control" id="guardName" required>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ $titleButton }}" data-bs-original-title="{{ $titleButton }}">
                <i class="ti-save"></i>
            </button>
        </div>
    </form>
</div>
