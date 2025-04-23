@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#D4C2FC]']) }}>
    {{ $value ?? $slot }}
</label>
