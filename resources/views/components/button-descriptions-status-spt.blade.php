@php
    $setup = (object) [
        'header_title' => 'deskripsi status SPT',
        'dropdown_list' => [
            (object) [
                'tab_title' => 'created',
                'tab_content_emphasized' => 'karyawan',
                'tab_content' => 'baru membuat pengajuan SPT',
            ],
            (object) [
                'tab_title' => 'revision',
                'tab_content_emphasized' => 'sekretariat',
                'tab_content' => 'menolak pengajuan SPT dengan memberikan note, kenapa dan apa yang perlu di perbaiki',
            ],
            (object) [
                'tab_title' => 'updated',
                'tab_content_emphasized' => 'karyawan',
                'tab_content' => 'mengubah SPT berdasarkan note yang diberikan oleh Sekretariat',
            ],
            (object) [
                'tab_title' => 'verified',
                'tab_content_emphasized' => 'sekretariat',
                'tab_content' => 'menyetujui pengajuan SPT, step selanjutnya menunggu Inspektur untuk meninjau SPT dengan hasil status Rejected atau Approved',
            ],
            (object) [
                'tab_title' => 'rejected',
                'tab_content_emphasized' => 'inspektur',
                'tab_content' => 'menolak pengajuan dengan memberikan note, kenapa dan apa yang perlu di perbaiki',
            ],
            (object) [
                'tab_title' => 'approved',
                'tab_content_emphasized' => 'inspektur',
                'tab_content' => 'menyetujui pengajuan SPT',
            ],
        ],
    ];
@endphp

<div id="btn-descriptions-status-spt" class="d-flex justify-content-end">
    <div id="" class="btn-group">
        <button type="button" role="button" data-bs-toggle="dropdown" aria-expanded="false"
            class="btn btn-sm btn-outline-secondary dropdown-toggle" title="Deskripsi status SPT"
            data-bs-original-title="Deskripsi status SPT">
            <i class="ti-info"></i>
        </button>
        <ul class="dropdown-menu medium">
            <li class="menu-header">
                <div class="dropdown-item">
                    {{ ucfirst($setup->header_title) }}
                </div>
            </li>
            <li class="menu-content">
                <div class="dropdown-item" style="white-space: normal;">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            @if (isset($setup->dropdown_list))
                                @foreach ($setup->dropdown_list as $idx => $dl)
                                    <button class="nav-link text-start @if ($idx == 0) active @endif"
                                        id="v-pills-{{ $dl->tab_title }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-{{ $dl->tab_title }}" type="button" role="tab"
                                        aria-controls="v-pills-{{ $dl->tab_title }}" aria-selected="true">
                                        {{ $idx + 1 }}.&nbsp;{{ ucfirst($dl->tab_title) }}
                                    </button>
                                @endforeach
                            @endif
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            @if (isset($setup->dropdown_list))
                                @foreach ($setup->dropdown_list as $idx => $dl)
                                    <div class="tab-pane fade @if ($idx == 0) show active @endif"
                                        id="v-pills-{{ $dl->tab_title }}" role="tabpanel"
                                        aria-labelledby="v-pills-{{ $dl->tab_title }}-tab">
                                        <p>
                                            <em>
                                                <b>{{ ucfirst($dl->tab_content_emphasized) }}</b>
                                            </em>&comma;&nbsp;
                                            {{ $dl->tab_content }}&#46;
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
