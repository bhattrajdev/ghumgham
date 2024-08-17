@extends('layouts.master')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.locations.index') }}" model="Location" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.locations.store') }}" method="POST" enctype="multipart/form-data">
                    
                    <x-form.row>
                        <x-form.input type="text" col="6" label="Title" :req="true" id="title"
                            name="title" value="{{ old('title') }}" />
                        <x-form.input type="text" col="6" label="Slug" :req="true" id="slug"
                            name="slug" value="{{ old('slug') }}" />
                    </x-form.row>

                    <x-form.row>
                        <div class="col-md-6">
                            <x-form.input type="file" label="Image" :req="true" id="image" name="image"
                                accept="image/*" onchange="previewThumb(this,'featured-thumb')" />
                            <x-form.preview id="featured-thumb" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input type="file" label="Cover (banner)" id="cover" :req="true" name="cover"
                                accept="image/*" onchange="previewThumb(this,'cover-thumb')" />
                            <x-form.preview id="cover-thumb" />
                        </div>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" col="6" label="Address" :req="true" id="address"
                            name="address" value="{{ old('address') }}" />
                        <div class="col-md-6">
                            <x-form.select label="Phase" :req="true" :options="\App\Enums\PhaseType::getPhaseList()" name="phase"
                                value="{{ old('phase') }}"></x-form.select>
                        </div>
                    </x-form.row>



                    <x-form.row>
                        <x-form.input type="text" col="12" label="Carousel Text" :req="true" id="carousel_text"
                            name="carousel_text" value="{{ old('carousel_text') }}" />
                    </x-form.row>

                    

                    <x-form.textarea label="Description" isEditor="true" :req="true" id="description"
                        name="description" value="{!! old('description') !!}" rows="5" cols="5" />
                    

                    <x-form.textarea label="Route" isEditor="true" :req="true" id="route" name="route"
                        value="{!! old('route') !!}" rows="5" cols="5" />
                    

                    <div class="col-md-12">
                        <label for="route" class="col-form-label">Google Map Location <span class="text-danger">*</span>
                        </label>
                        <x-google-map :is-editable="true" />
                    </div>
                    </br>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" />
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
