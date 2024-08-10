<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'slug' => "required|string|unique:blogs,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'user_id' => 'nullable',
            'publish_date' => 'required|date',
            'phase' => 'nullable',
            'order' => 'nullable|numeric',
            'status' => 'boolean',
        ];
    }
}
