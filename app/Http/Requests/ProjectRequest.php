<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title_en' => 'required',
            'description_en' => 'required',
            'location_en' => 'required',
            'scope_en' => 'required',
            'link' => 'required',
            'category_id' => 'required',
            // Add more rules as needed
        ];
    }
}
