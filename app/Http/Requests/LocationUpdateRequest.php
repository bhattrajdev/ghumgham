<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationUpdateRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('locations')->ignore($this->location->id, 'id')
            ],
            'description' => 'required|string|min:3',
            'route' => 'required|string|min:3',
            'address' => 'required|string',
            'carousel_text' => 'required|string',
            'user_id' => 'nullable',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'phase' => 'required|string',
            'status' => 'boolean',
        ];
    }
}
