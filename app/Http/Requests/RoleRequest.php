<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            // 'name' => ['required', 'min:3', 'max:255'],
            // jika hanya ada 1 unique field dalam 1 tabel bisa menggunakan ini, artinya dalam 1 kolom tidak boleh ada data yang sama
            // 'name' => ['required', 'min:3', 'max:255', Rule::unique('roles')->ignore($this->role)],
            /**
             * pada aturan table Roles database spatie,
             * terdapat 2 unique kolom, yang artinya setiap baris tidak boleh mempunya 2 value kolom yang sama
             * jadi jika sudah ada user paga dengan roles admin, maka tidak boleh ada data dengan nama user paga dengan role admin
             * tetapi, jika user paga dengan roles manager diperbolehkan
             */

            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('roles', 'name')->where('guard_name', $this->input('guard_name'))
            ],
            'guard_name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('roles', 'guard_name')->where('name', $this->input('name'))
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Roles for selected name on selected guard name already exists.',
            'guard_name.unique' => 'Roles for selected guard name on selected name already exists.',
        ];
    }
}
