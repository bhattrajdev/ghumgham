<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingUpdateRequest extends FormRequest
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
            'site_title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'email' => 'required|email',
            'alternate_email' => 'nullable|email',
            'phone_number1' => 'required|regex:/(\+977)?[9][6-9]\d{8}/',
            'phone_number2' => 'nullable|regex:/(\+977)?[9][6-9]\d{8}/',
            'address1' => 'required|string',
            'twitter_link' => 'nullable|url',
            'fb_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'footer_info' => 'required|string',
            'description' => 'nullable|string|min:10',
        ];
    }
}
