@extends('layouts.master')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.blogs.index') }}" model="Blog" item="Edit"></x-breadcrumb>


        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')

                    <div class="card">
                        <div class="card-body">
                            <x-form.wrapper action="{{ route('admin.blogs.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <x-form.row>
                                    <x-form.input type="text" col="6" label="Title" :req="true"
                                        id="title" name="title" value="{{ $blog->title }}" />
                                    <x-form.input type="text" col="6" label="Slug" :req="true"
                                        id="slug" name="slug" value="{{ $blog->slug }}" />
                                </x-form.row>

                                <x-form.row>
                                    <x-form.input type="date" col="6" label="Publish Date" :req="true"
                                        id="publish_date" name="publish_date" value="{{ $blog->publish_date }}" />

                                        <div class="col-md-6">
                                            <x-form.select label="Phase" :req="true" :options="\App\Enums\PhaseType::getPhaseList()" name="phase"
                                                value="{{ old('phase', $blog->phase) }}"></x-form.select>
                                        </div>
                                <br />

                                </x-form.row>

                                
                                <br />

                                <x-form.textarea label="Description" isEditor="true" :req="true" id="description"
                                    name="description" value="{!! $blog->description !!}" rows="5" cols="5" />

                                <br />

                                {{-- <x-form.select label="Package" :req="true" :options="$packages" name="packages"></x-form.select> --}}


                                <x-form.checkbox label="Status" id="status" name="status" value="1"
                                    class="form-check-input" :isChecked="$blog->status ? 'checked' : '' " />

                                <x-form.button class="btn btn-sm btn-dark" type="submit">
                                    <i class='bx bx-save bx-xs'></i> Save
                                </x-form.button>
                            </x-form.wrapper>
                        </div>
                    </div>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {{-- @include('_helpers.slugify', ['title' => 'title']) --}}
    @include('_helpers.image_preview', ['name' => 'image'])
    @include('_helpers.image_preview', ['name' => 'cover'])
    @include('_helpers.ck_editor')
    @include('_helpers.ajax_form')
@endpush
