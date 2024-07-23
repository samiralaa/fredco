<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules()
    {
        return [
            'message' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            // Add more rules as needed
        ];
    }
}
