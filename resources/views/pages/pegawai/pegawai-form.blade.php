@php
    if ($data->id) {
        $action = route('pegawai.update', $data->id);
        $method = 'PATCH';
        $titleButton = 'Save Change';
    } else {
        $action = route('pegawai.store');
        $method = 'POST';
        $titleButton = 'Save';
    }
@endphp

<div class="modal-content">
    <form id="form-action" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" value="{{ $data->nip }}" placeholder="NIP" name="nip"
                            class="form-control" id="nip" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Nama</label>
                        <input type="text" value="{{ $data->nama }}" placeholder="Nama" name="nama"
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
            <div class="col-md-12 mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="js-example-basic-single form-select " id="jabatan" name="jabatan_id">
                    <option></option>
                    @foreach ($jabatan as $j)
                        <option @if ($j->id == $data->jabatan_id) selected @endif value="{{ $j->id }}">
                            {{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="pangkat_golongan" class="form-label">Pangkat Golongan</label>
                <select class="js-example-basic-single form-select " id="pangkat_golongan" name="pangkat_golongan_id">
                    <option></option>
                    @foreach ($pangkat_golongan as $p)
                        <option @if ($p->id == $data->pangkat_golongan_id) selected @endif value="{{ $p->id }}">
                            {{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="kelas_perjadin" class="form-label">Kelas Perjadin</label>
                <select class="js-example-basic-single form-select " id="kelas_perjadin" name="kelas_perjadin_id">
                    <option></option>
                    @foreach ($kelas_perjadin as $k)
                        <option @if ($k->id == $data->kelas_perjadin_id) selected @endif value="{{ $k->id }}">
                            {{ $k->kategori }}</option>
                    @endforeach
                </select>
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
