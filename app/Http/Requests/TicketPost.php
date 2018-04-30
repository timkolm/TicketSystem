<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketPost extends FormRequest
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
            "name" => ["required","regex:/^[0-9A-Za-z\s-_\/]+$/"],
            "subject" => ["required", $regexText],
            "urgency" => ["required","regex:/^[A-Za-z\s]+$/"],
            "description" => ["required", $regexText],
        ];
    }
}
