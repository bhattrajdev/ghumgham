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
    'selected',
])

<div class="col-md-{{ $col }}">
    @if ($labelDisplay === true)
        <label for="{{ $id }}" class="col-form-label">{{ $label }} @if ($req === true)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="" class="d-block">label A</label>
                <input type="search" name="" id=""
                    class="rounded text-dark border border-secondary form-control px-1" placeholder="search here.."
                    style="width: fit-content">
            </div>
            <ul class="draggable-multiselect  p-2">
                <li>One</li>
                <li>Two</li>
                <li>Three</li>
                <li>Four</li>
                <li>Five</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="" class="d-block">label B</label>
                <input type="search" name="" id=""
                    class="rounded text-dark border border-secondary form-control px-1" placeholder="search here.."
                    style="width: fit-content">
            </div>
            <ul class="draggable-multiselect  p-2">
                <li>Six</li>
                <li>Seven</li>
                <li>Eight</li>
                <li>Nine</li>
                <li>Ten</li>
            </ul>
        </div>
    </div>
    @error($name)
        <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>
