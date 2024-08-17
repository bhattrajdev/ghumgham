@extends('layouts.master')

@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.locations.index') }}" model="Location" item="Edit"></x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.locations.update', $location->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')

                <x-form.row>
                    <x-form.input type="text" col="6" label="Title" :req="true" id="title" name="title"
                        value="{{ $location->title }}" />
                    <x-form.input type="text" col="6" label="Slug" :req="true" id="slug" name="slug"
                        value="{{ $location->slug }}" />
                </x-form.row>

                <x-form.row>
                    <div class="col-lg-6">
                        <x-form.input type="file" label="Image" :req="true" id="image" name="image" accept="image/*"
                            onchange="previewThumb(this,'blog-thumb')" />
                        <x-form.preview id="blog-thumb" url="{{ $location->feature_image->getPath() }}" />
                    </div>
                    <div class="col-lg-6">
                        <x-form.input type="file" label="Cover(banner)" :req="true" id="cover" name="cover"
                            accept="image/*" onchange="previewThumb(this,'cover-thumb')" />
                        <x-form.preview id="cover-thumb" url="{{ $location->cover_image->getPath() }}" />
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="Address" :req="true" id="address" name="address"
                        value="{{ $location->address }}" />

                    <div class="col-md-6">
                        <x-form.select label="Phase" :req="true" :options="\App\Enums\PhaseType::getPhaseList()"
                            name="phase" value="{{ old('phase', $location->phase) }}"></x-form.select>
                    </div>
                </x-form.row>



                <x-form.row>
                    <x-form.input type="text" col="12" label="Carousel Text" :req="true" id="carousel_text"
                        name="carousel_text" value="{{ old('carousel_text',$location->carousel_text) }}" />
                </x-form.row>

                <x-form.textarea label="Description" isEditor="true" :req="true" id="description" name="description"
                    value="{!! $location->description !!}" rows="5" cols="5" />

                <x-form.textarea label="Route" isEditor="true" :req="true" id="route" name="route"
                    value="{!! $location->route !!}" rows="5" cols="5" />

                <div class="col-md-12">
                    <label for="route" class="col-form-label">Google Map Location <span class="text-danger">*</span>
                    </label>
                    <x-google-map :is-editable="true" latitude="{{ $location->latitude }}"
                        longitude="{{ $location->longitude }}" />
                </div>

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input"
                    :isChecked="$location->status ? 'checked' : ''" />
                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save
                </x-form.button>

            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
@include('_helpers.slugify', ['title' => 'title'])
@include('_helpers.image_preview', ['name' => 'image'])
@include('_helpers.ck_editor')
@include('_helpers.ajax_form')
@endpush