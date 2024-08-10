<ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.edit', ['package' => $package->id]) }}"
            class="nav-link {{ $active == 'package' ? 'active' : '' }}">Package</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.itinerary.index', ['package' => $package->id]) }}"
            class="nav-link {{ $active == 'itinerary' ? 'active' : '' }}">Itinerary</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.gallery.index', ['package' => $package->id]) }}"
            class="nav-link {{ $active == 'gallery' ? 'active' : '' }}">Gallery</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.departure.index', ['package' => $package->id]) }}"
            class="nav-link {{ $active == 'departure' ? 'active' : '' }}">Departure</a>
    </li>
    {{-- <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.group.index', ['package' => $package->id]) }}" class="nav-link {{$active=='group'?"active":""}}">Group</a>
    </li> --}}

    {{-- <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.review.index', ['package' => $package->id]) }}"
            class="nav-link {{ $active == 'review' ? 'active' : '' }}">Review</a>
    </li> --}}
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.packages.seo.index', $package->id) }}"
            class="nav-link {{ $active == 'seo' ? 'active' : '' }}">SEO</a>
    </li>
</ul>
