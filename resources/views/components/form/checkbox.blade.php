@props([
    'id' => $name,
    'label' => 'CheckBox',
    'class' => 'form-check-input',
    'value' => 1,
    'message' => '',
    'isChecked' => '',
    'isEditMode' => '',
    'col' => '12',
    'isBreak' => false,
    'name',
])

<div class="form-check col-md-{{ $col }}">
    @if (isset($isEditMode))
        <input type="hidden" name="{{ $name }}" value="0">
    @endif
    @if ($isBreak)
        <div style="margin-bottom:1.1rem">&nbsp;</div>
    @endif
    <input type="checkbox" class="{{ $class }}" name="{{ $name }}" id="{{ $id }}"
        value="{{ $value }}" {{ $attributes }} @if (isset($isEditMode)) {{ $isChecked }} @endif>
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
</div>
