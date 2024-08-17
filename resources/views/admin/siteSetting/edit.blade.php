@extends('layouts.master')

@section('content')
<div class="container-xxl">

    <x-breadcrumb model="Edit SiteSetting"></x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.sitesettings.update', $site_setting->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
          
                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Site Title" id="site_title" name="site_title" value="{{ $site_setting->site_title }}" />
                    <div class="col-6">
                        <x-form.input type="file" :req="true" label="Site Image" id="image" name="image" accept="image/*" onchange="previewThumb(this,'featured-thumb')" />
                        <x-form.preview id="featured-thumb" url="{{ $site_setting->feature_image->getPath() }}" class="mt-3" />
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Email" id="email" name="email" value="{{ $site_setting->email }}" />
                    <x-form.input type="text" col="6" label="Alternate Email" id="alternate_email" name="alternate_email" value="{{ $site_setting->alternate_email }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Phone Number" id="phone_number1" name="phone_number1" value="{{ $site_setting->phone_number1 }}" />
                    <x-form.input type="text" col="6" label="Alternate Phone Number" id="phone_number2" name="phone_number2" value="{{ $site_setting->phone_number2 }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Address1" id="address1" name="address1" value="{{ old('address1', $site_setting->address1) }}" />
                    <x-form.input type="text" col="6" label="Address2" id="address2" name="address2" value="{{ old('address2', $site_setting->address2) }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="4" label="Twitter Link" id="twitter_link" name="twitter_link" value="{{ $site_setting->twitter_link }}" />
                    <x-form.input type="text" col="4" label="Facebook Link" id="fb_link" name="fb_link" value="{{ $site_setting->fb_link }}" />
                    <x-form.input type="text" col="4" label="Instagram Link" id="insta_link" name="insta_link" value="{{ $site_setting->insta_link }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="Youtube Link" id="youtube_link" name="youtube_link" value="{{ $site_setting->youtube_link }}" />
                    <x-form.input type="text" col="6" label="Tiktok Link" id="tiktok_link" name="tiktok_link" value="{{ $site_setting->tiktok_link }}" />
                </x-form.row>
                
                <x-form.textarea isEditor="true" label="Description" id="description" name="description" value="{!! $site_setting->description !!}" rows="5" cols="5" />

                <x-form.textarea isEditor="true" label="Company Info(Footer)" id="footer_info" name="footer_info" value="{!! $site_setting->footer_info !!}" rows="5" cols="5" />
                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save</x-form.button>
            </x-form.wrapper>
            
        </div>
    </div>
</div>
@endsection

@push('custom_js')
@include('_helpers.image_preview', ['name' => 'image'])
@include('_helpers.ajax_form')
@endpush