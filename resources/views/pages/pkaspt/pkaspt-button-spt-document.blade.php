<div class="d-flex">
    <a type="button" href="{{ $data->file_pengajuan_spt ? asset('dokumen/spt/' . $data->file_pengajuan_spt) : '#' }}"
        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->file_pengajuan_spt ?? 'Belum ada file' }}"
        class="btn btn-action btn-sm btn-outline-primary icon-left {{ $data->file_pengajuan_spt ? '' : 'disabled' }}"
        aria-disabled="{{ $data->file_pengajuan_spt ? 'false' : 'true' }}"
        tabindex="{{ $data->file_pengajuan_spt ? '' : 0 }}">
        <i class="ti-folder"></i>
        Word SPT
    </a>
</div>
