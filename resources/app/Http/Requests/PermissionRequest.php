<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
			'name' => 'required|unique:permissions,name',
			'display_name' => 'required|unique:permissions,display_name'
        ];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Kolom nama wajib diisi',
			'name.unique' => 'Kolom nama sudah ada',
			'display_name.required' => 'Kolom nama display wajib diisi',
			'display_name.unique' => 'Kolom nama display sudah ada',
		];
	}
}
