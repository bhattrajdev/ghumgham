@extends('layouts.master')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb model="Location"></x-breadcrumb>

        <div class="card">

            <div class="card-body">
                <div class="d-flex justify-content-end">

                    <a href="{{ route('admin.locations.create') }}" class="btn btn-sm btn-dark mb-2"><i
                            class='bx bx-xs bx-plus'>
                        </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['image','title', 'address', 'phase', 'Actions']" />
                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModel" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="max-width:100% !important">
                <div class="modal-header">
                    <h5 class="modal-title">Location Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        $(document).on('show.bs.modal', '.modal', function(event) {
            let button = $(event.relatedTarget);
            let contactId = button.data('show-id');
            let modal = $(this);

            let url = "{{ route('admin.locations.show', ':id') }}".replace(':id', contactId);
            modal.find('.modal-body').html("<p class='d-flex justify-content-center'>Loading...</p>");
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                success: function(response) {
                    modal.find('.modal-body').html(response);
                }
            });
        });
    </script>
    @include('_helpers.yajra', ['url' => route('admin.locations.index'), 'columns' => $columns])
    @include('_helpers.swal_delete')
    @include('_helpers.status_change', ['url' => route('admin.locations.status')])
    {{-- @include('_helpers.row_reorder', ['url' => route('blog.reorder')]) --}}
@endpush
