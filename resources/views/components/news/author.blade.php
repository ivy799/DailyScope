@props(['author', 'size'])

@php
    $imageSize = match ($size ?? null) {
        'sm' => 'w-7 h-7',
        'md' => 'w-10 h-10',
        'lg' => 'w-14 h-14',
        default => 'w-10 h-10',
    };

    $textSize = match ($size ?? null) {
        'sm' => 'text-xs',
        'md' => 'text-base',
        'lg' => 'text-lg',
        default => 'text-base',
    };
@endphp

<img class="{{ $imageSize }} rounded-full mr-3" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}">
<span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>
