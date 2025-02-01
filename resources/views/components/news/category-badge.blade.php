@props(['category'])
<x-badge wire:navigate href="{{ route('news.index', ['category' => $category->title]) }}"
    text_color='{{ $category->text_color }}' bg_color='{{ $category->bg_color }}'>
    {{ $category->title }}
</x-badge>
