@if(isset($routeView))
    <a href="{{$routeView}}" class="btn btn-sm btn-default" title="View" {{$attributes}}>
        <i class='bx bx-show-alt'></i>
    </a>
@endif