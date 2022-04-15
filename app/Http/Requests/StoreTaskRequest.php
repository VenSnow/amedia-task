<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'theme' => 'required|min:3|max:255',
            'message' => 'required|min:3|max:5000',
            'user_name' => 'required|min:3|max:255',
            'client_email' => 'required|email|max:50',
            'file' => 'required|mimes:png,jpeg,jpg,pdf|max:4096',
        ];
    }
}
