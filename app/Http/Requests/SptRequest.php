<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'nomor_pengajuan' => [
                'required',
                'min:3',
                'max:225'
            ],
            'sifat_penugasan' => [
                'required',
            ],
            'lama_penugasan' => [
                'required',
                'numeric'
            ],
            'tanggal_mulai_spt' => [
                'date'
            ],
            'tanggal_selesai_spt' => [
                'date'
            ],
            'keperluan_tugas' => [],
            'keterangan_tugas' => [],
            'note' => [],
        ];
    }
}
