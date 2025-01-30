@props(['text_color', 'bg_color'])

@php
    $text_color = match ($text_color) {
        'gray' => 'text-gray-800',
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'yellow' => 'text-yellow-800',
        default => 'text-gray-800',
    };

    $bg_color = match ($bg_color) {
        'gray' => 'bg-gray-100',
        'blue' => 'bg-blue-100',
        'red' => 'bg-red-100',
        'yellow' => 'bg-yellow-100',
        default => 'bg-gray-100',
    };
@endphp

<a href="#"
    class="{{ $text_color }} {{ $bg_color }} rounded-xl px-3 py-1 text-base">{{ $slot }}
</a>
