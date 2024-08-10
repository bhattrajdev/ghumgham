<div class="card shadow-sm">
    <div class="card-body ">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <b class="text-uppercase">Title:</b>
                <span>{{ $location->title }}</span>
            </li>

            <li class="list-group-item">
                <b class="text-uppercase">Address:</b>
                <span>{{ $location->address }}</span>
            </li>

            {{-- Phase Case --}}
            <li class="list-group-item ">
                <b class="text-uppercase">Phase:</b>
                <span
                    class="badge rounded-pill 
                    @switch($location->phase)
                        @case('pending')
                            bg-label-warning text-dark
                            @break
                        @case('accepted')
                            bg-label-success
                            @break
                        @case('cancelled')
                            bg-label-danger
                            @break
                        @default
                            bg-label-secondary
                    @endswitch
                ">
                    {{ $location->phase }}
                </span>
            </li>

            {{-- Status Case --}}
            <li class="list-group-item ">
                <b class="text-uppercase ">Status:</b>
                <span
                    class="badge rounded-pill 
                    @switch($location->status)
                        @case(0)
                            bg-label-danger
                            @break
                        @case(1)
                            bg-label-success
                            @break
                        @default
                            bg-label-secondary
                    @endswitch">
                    
                    @switch($location->status)
                        @case(0)
                            Inactive
                        @break

                        @case(1)
                            Active
                        @break

                        @default
                            Unknown
                    @endswitch
                </span>
            </li>

            {{-- User Information --}}
            <li class="list-group-item">
                <b class="text-uppercase ">Author:</b>
                <div class="d-flex flex-column mt-2">
                    <div class="bg-light p-3 rounded border">
                        <p class="mb-1"><strong>Name:</strong> <span
                                class="fw-semibold">{{ $location->user->name }}</span></p>
                        <p class="mb-0"><strong>Email:</strong> <span
                                class="fw-semibold">{{ $location->user->email }}</span></p>
                        <p class="mb-0"><strong>Role:</strong> <span
                                class="fw-semibold">{{ $location->user->role }}</span></p>
                    </div>
                </div>
            </li>
        </ul>

        <div class="p-3 ">
            <b class="d-block text-uppercase">Location:</b>
            <x-google-map :is-editable="false" latitude="{{ $location->latitude }}"
                longitude="{{ $location->longitude }}" />
        </div>


        <div class="border-top p-3 mt-2 ">
            <b class="d-block text-uppercase ">Description:</b>
            <div class="p-3 mt-2 rounded" style="background-color: #f8f9fa;">
                <p class="m-0 text-justify">{!! $location->description !!}</p>
            </div>
        </div>


        <div class="border-top p-3 mt-2 ">
            <b class="d-block text-uppercase ">Route:</b>
            <div class="p-3 mt-2 rounded" style="background-color: #f8f9fa;">
                <p class="m-0 text-justify">{!! $location->route !!}</p>
            </div>
        </div>
    </div>
</div>
