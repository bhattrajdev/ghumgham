@props([
  'uri' => 'home',
  'name' => 'Sidebar Item',
  'newtab'=>false,
  'route'
])


<li class="menu-item {{ (request()->is($uri) || request()->is($uri . '/*')) ? 'active' : ''  }}">
    <a href="{{$route}}" class="menu-link" {{$newtab?"target='_blank'":""}}>
        {{$slot}}
        <div data-i18n="Analytics">{{$name}}</div>
    </a>
</li>