<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust as needed
    }

    public function rules(): array
    {
        return [
            'slug' => "required|string|unique:blogs,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,gif,webp|max:2048',
            'cover' => 'required|image|mimes:png,jpg,jpeg,svg,gif,webp|max:2048',
            'user_id' => 'nullable', 
            'location_id' => 'required',
            'publish_date' => 'required|date',
            'phase' => 'nullable',
            'order' => 'nullable|numeric',
            'status' => 'boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(), // Set user_id dynamically
        ]);
    }
}
