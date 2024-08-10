<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('admin/dashboard') }}" class="app-brand-link bg-primary pl-3 mt-2 w-100">
            {{-- @if ($setting && $setting->feature_image)
                <img src="{{ $setting->feature_image->getPath() }}" alt="{{ $setting->site_title }}" height="40px"
                    width="100px">
            @else
                <img src="{{ asset('front_assets/img/logo.png') }}" alt="Site Logo" height="40px" width="100px">
            @endif --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner gap-2 py-1 mt-4">
        <x-sidebar-item route="{{ url('/') }}" name="Visit Site" uri="/" :newtab="true">
            <i class="menu-icon tf-icons bx bx-world"></i>
        </x-sidebar-item>
        <x-sidebar-item route="{{ route('admin.dashboard') }}" name="Dashboard" uri="admin/dashboard">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
        </x-sidebar-item>
        <x-sidebar-item route="{{ route('admin.blogs.index') }}" name="Blog" uri="admin/blogs">
            <i class="menu-icon tf-icons bx bxs-book-open"></i>
        </x-sidebar-item>

        <x-sidebar-item route="{{route('admin.locations.index')}}" name="Location" uri="admin/locations">
            <i class="menu-icon tf-icons bx bx-current-location"></i>
            
        </x-sidebar-item>


    </ul>
</aside>
