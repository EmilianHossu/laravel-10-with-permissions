@props(['value', 'mandatory' => false])

<label {{ $attributes->merge(['class' => 'block font-bold text-base text-gray-700']) }}>
    {{ $value ?? $slot }} @if($mandatory)<span class="text-red-700">*</span>@endif
</label>
