<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiRequest extends FormRequest
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
            'nip' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('pegawai')->ignore($this->role)
            ],
            'nama' => [
                'required',
                'min:3',
                'max:255',
            ],
            'jabatan_id' => [
                'required',
                'numeric'
            ],
            'pangkat_golongan_id' => [
                'required',
                'numeric'
            ],
            'kelas_perjadin_id' => [
                'required',
                'numeric'
            ]
        ];
    }
}
