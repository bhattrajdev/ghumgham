@extends('layouts.master')

@section('content')
    <style>
        ul li {
            padding: 4px;
            transition: all 300ms ease;
        }

        ul li:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-lg-4 mb-4">
                                <div class="card p-3">
                                    <a href="{{ url('admin/Blogs') }}" class="d-inline">
                                        <div class="wrapper d-flex pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><i
                                                        class="bx bx-sitemap"></i></span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0 fw-bold">Blogs</h6>
                                                </div>
                                                <div class="user-progress">
                                                    {{-- <small class="fw-semibold text-dark">{{ $blog_count }}</small> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <div class="card p-3">
                                    <a href="{{ url('admin/packages') }}" class="d-inline">
                                        <div class="wrapper d-flex pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><i
                                                        class="bx bx-package"></i></span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0 fw-bold">Locations</h6>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold text-dark">
                                                        {{-- {{ $location_count }} Locations --}}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Add additional sections here if needed -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModel" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Booking Detail</h5>
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
@endpush
