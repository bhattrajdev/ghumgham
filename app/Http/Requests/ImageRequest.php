<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alt' => 'required|string|min:1',
            'order' => 'required|numeric',
            'image' => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp,avi,mp4|max:20048',
        ];
    }
}
