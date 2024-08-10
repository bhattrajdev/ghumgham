@props([
'id' => $name,
'label' => 'Select',
'class' => 'form-control',
'value' => '',
'type' => 'text',
'message' => '',
'col' => '12',
'req' => false,
'labelDisplay' => true,
'optionDisplay' => true,
'model' => null,
'_key' => null,
'name',
'options',
'selected' => [],
])

<div class="col-md-{{ $col }}">
    @if ($labelDisplay === true)
    <label for="{{ $id }}" class="col-form-label">{{ $label }} @if ($req === true)
        <span class="text-danger">*</span>
        @endif
    </label>
    @endif
    <div class="">
        <select id="{{ $id }}" class="multiselect multi-select-container" multiple="multiple" name="{{ $name }}[]">
            @foreach ($selected as $select)
            <option value="{{ $select }}" selected="selected">
                {{ $options[$select] }}
            </option>
            @php
            unset($options[$select]);
            @endphp
            @endforeach
            @foreach ($options as $key => $option)
            <option value="{{ $key }}">
                {{ $option }}
            </option>
            @endforeach
        </select>
    </div>
    @error($name)
    <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>

@push('custom_js')
<link type="text/css" rel="stylesheet" href="/assets/multiselect/css/jquery-ui.css" />
<link type="text/css" href="/assets/multiselect/css/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="/assets/multiselect/js/jquery-ui.js"></script>
<script type="text/javascript" src="/assets/multiselect/js/ui.multiselect.js"></script>
<script>
    $(".multiselect").multiselect();
</script>
@endpush