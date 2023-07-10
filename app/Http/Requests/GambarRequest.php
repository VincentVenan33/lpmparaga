<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GambarRequest extends FormRequest
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
            'judul_foto' => ['required', 'string', 'max:255', 'unique:fotos'],
            'id_news' => ['required', 'string', 'max:255'],
            'id_admin' => ['required', 'string', 'max:255'],
        ];
    }
}