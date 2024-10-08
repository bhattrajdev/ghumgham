@props([
    'id' => $name,
    'label' => 'Label',
    'class' => '',
    'value' => '',
    'type' => 'text',
    'message' => '',
    'col' => '12',
    'req' => false,
    'readonly' => false,
    'labelDisplay' => true,
    'name',
])
<div class="col-md-{{ $col }}">
    @if ($labelDisplay === true)
        <label for="{{ $id }}" class="col-form-label">{{ $label }} @if ($req === true)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    @if ($readonly)
        <div id="{{ $id }}" {{ $attributes->merge(['class' => $class . ' form-control text-14']) }}>
            {{ $value }}</div>
    @else
        <input type="{{ $type }}" {{ $attributes->merge(['class' => $class . ' form-control text-14']) }}
            name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {{ $attributes }}>
        @error($name)
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    @endif
</div>
