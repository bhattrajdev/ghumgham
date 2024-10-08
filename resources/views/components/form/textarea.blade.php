@props([
'id' => $name,
'label' => 'Label',
'class' => 'form-control text-14',
'value' => '',
'type' => 'text',
'message' => '',
'isEditor'=>false,
'col' => '12',
'req' => false,
'name'
])

<div class=" mt-2 col-md-{{$col}} ">
    <label for="{{$id}}" class="col-form-label">{{$label}} @if($req === true)
        <span class="text-danger">*</span>
        @endif</label>
    <textarea class="{{$class}} {{$isEditor?'tinymce':''}}" name="{{$name}}" id="{{$id}}" {{$attributes}}>{{$value}}</textarea>
    @error($name) <span class="text-danger small">{{ $message }}</span> @enderror
</div>
