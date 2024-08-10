<ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.edit', $team->id) }}" class="nav-link {{ $active == 'team' ? 'active' : '' }}">Team</a>
    </li>

    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.doc.index', $team->id) }}"
            class="nav-link {{ $active == 'doc' ? 'active' : '' }}">Docs</a>
    </li>
    {{-- <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.gallery.index', $team->id) }}" class="nav-link {{$active=='gallery'?"active":""}}">Gallery</a>
    </li> --}}
    {{-- <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.group.index', $team->id) }}" class="nav-link {{$active=='group'?"active":""}}">Group</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.review.index', $team->id) }}" class="nav-link {{$active=="review"?"active":""}}">Review</a>
    </li> --}}
    <li class="nav-item" role="presentation">
        <a href="{{ route('admin.teams.seo.index', $team->id) }}"
            class="nav-link {{ $active == 'seo' ? 'active' : '' }}">SEO</a>
    </li>
</ul>
