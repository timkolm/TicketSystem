<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentPost extends FormRequest
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
        $regexText = "regex:/^[0-9A-Za-z\s\-_,\.\:;\(\)@#\$%\^&\*\/\+\='\?\!\"\|\{\}\[\]~`]+$/";
        return [
            "user" => ["required","regex:/^[0-9A-Za-z\s-_\/]+$/"],
            "body" => ["required", $regexText],
            "ticket_id" => "required|integer",
        ];
    }
}
