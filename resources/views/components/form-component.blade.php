@props([
'type'=>'text',
'name'=>'',
'label'=>'',
'value'=>'',
])
<div class="form-floating mb-3">
    <input type="{{ $type }}" @class(['form-control', 'is-invalid' => $errors->has($name)]) name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $label }}" value="{{ old($name,$value) }}">
    <label for="name">{{ $label }}</label>
    <x-error-form name="{{ $name }}" message={{ $message }} />
</div>