@extends('layouts.master')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb listRoute="{{ route('admin.blogs.index') }}" model="Blog" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="text" col="6" label="Title" :req="true" id="title"
                            name="title" value="{{ old('title') }}" />
                        <x-form.input type="text" col="6" label="Slug" :req="true" id="slug"
                            name="slug" value="{{ old('slug') }}" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="date" col="6" label="publish Date" :req="true" id="publish_data"
                            name="publish_date" value=" {{ old('publish_date') }}" />
                        <div class="col-md-6">
                            <x-form.select label="location" :req="true" :options="$location"
                                name="location_id"></x-form.select>
                        </div>
                    </x-form.row>



                    <x-form.row>
                        <div class="col-md-6">
                            <x-form.input type="file" label="Image" :req="true" id="image" name="image"
                                accept="image/*" onchange="previewThumb(this,'featured-thumb')" />
                            <x-form.preview id="featured-thumb" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input type="file" label="Cover" id="cover" :req="true" name="cover"
                                accept="image/*" onchange="previewThumb(this,'cover-thumb')" />
                            <x-form.preview id="cover-thumb" />
                        </div>
                    </x-form.row>

                    <div class="col-md-6">
                        <x-form.select label="Phase" :req="true" :options="\App\Enums\PhaseType::getPhaseList()" name="phase"
                            value="{{ old('phase') }}"></x-form.select>
                    </div>
                    <br />
                    <x-form.textarea label="Description" isEditor="true" :req="true" id="description"
                        name="description" value="{!! old('description') !!}" rows="5" cols="5" />
                    <br />
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
