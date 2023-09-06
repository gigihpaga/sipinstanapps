<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PkaRequest extends FormRequest
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
            'pka_no' => [
                'required',
                'min:3',
                'max:225'
            ],
            'nama_opd' => [
                'required',
                'min:3',
                'max:225'
            ],
            'alamat' => [
                'required',
                'min:3',
                'max:225'
            ],
            'keterangan' => [
                'required',
                'min:3',
                'max:225'
            ],
            'tanggal_mulai' => [
                'required',
                'date'
            ],
            'tanggal_selesai' => [
                'required',
                'date'
            ],
            'nama_file_pdf' => [
                'required',
                File::types(['pdf'])->min(2)->max(2000),
                // 'mimes:pdf',
                // 'min:2',
                // 'max:2000',
                // 'file',
            ]
        ];
    }
}
