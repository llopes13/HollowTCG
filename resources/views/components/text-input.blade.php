@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#D4C2FC] focus:ring-[#D4C2FC] text-black rounded-md shadow-sm']) }}>
