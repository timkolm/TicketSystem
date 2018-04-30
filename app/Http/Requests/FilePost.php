<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilePost extends FormRequest
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
        $rules = [];
        $files = count($this->input('files'));
        foreach(range(0, $files) as $index) {
            $rules['files.' . $index] = 'image|mimes:jpg,jpeg,bmp,png|max:2000';
        }
        return $rules;
    }
}
