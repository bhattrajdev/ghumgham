@props([
'method' => 'POST',
'action'
])

<form class="ajaxform" action="{{$action}}" method="{{$method}}" {{ $attributes }}>
    @csrf

    {{ $slot }}
    <div id="errorlist" style="margin-top:20px"></div>
</form>
