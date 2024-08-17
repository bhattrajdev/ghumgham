<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'slug' => "required|string|unique:blogs,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,gif,webp|max:2048',
            'cover' => 'required|image|mimes:png,jpg,jpeg,svg,gif,webp|max:2048',
            'carousel_text' => 'required|string',
            'description' => 'required|string|min:3',
            'route' => 'required|string|min:3',
            'address' => 'required|string',
            'user_id' => 'nullable',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'phase' => 'nullable',
            'status' => 'boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(),
        ]);
    }
}
