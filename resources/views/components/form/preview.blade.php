@props([
'id',
'type'=>'image',
'url' => null,
'default_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
])
<div class="image-thumb mt-3" style="@isset($url)display:block;@else display: none;@endisset width:150px;aspect-ratio:4/3;position: relative;" id="{{$id}}">
    @if($type=="image" || $url == "")
    <img src="@if(isset($url) && $url != ""){{$url}} @else {{$default_url}} @endif" alt="title" class="w-100 card-img">
    @else
    <div class="video-preview"><video src="{{$url}}" controls style="max-width: 200px; max-height: 200px;"></div>
    @endif
    <button type="button" onclick="resetImage('{{$id}}')" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
        <i class='bx bx-x bx-xs bx-tada-hover'></i>
    </button>
</div>
<style>
    .image-thumb img {
        max-width: 100%
    }

</style>
