<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'kat_berita' => ['required', 'string', 'max:255'],
            'judul' => ['required', 'string', 'max:255', 'unique:beritas'],
            'isi' => ['required', 'string'],
            'id_admin' => ['required', 'string', 'max:255'],
        ];
    }
}