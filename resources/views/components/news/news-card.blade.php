@props(['news'])

<div {{ $attributes }}>
    <a wire:navigate href="{{ route('news.show', $news->slug) }}">
        <div>
            <img class="w-full rounded-xl"
                src="{{ $news->getThumbnailImage() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-5">
            @if ($category = $news->category()->first())
                <x-news.category-badge :category="$category" />
            @endif
            <p class="text-gray-500 text-sm">{{ $news->published_at }}</p>
        </div>
        <a wire:navigate href="{{ route('news.show', $news->slug) }}" class="text-xl font-bold text-gray-900">{{ $news->title }}</a>
    </div>
</div>
