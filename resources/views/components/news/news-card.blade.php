@props(['news'])

<div {{ $attributes }}>
    <a href="#">
        <div>
            <img class="w-full rounded-xl"
                src="{{ $news->getThumbnailImage() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-5">
            @if ($category = $news->category()->first())
                <x-badge wire:navigate href="{{ route('news.index', ['category' => $category->slug]) }}" :text_color="$category->text_color" :bg_color="$category->bg_color">{{ $category->title }}</x-badge>     
            @endif
            <p class="text-gray-500 text-sm">{{ $news->published_at }}</p>
        </div>
        <a href="#" class="text-xl font-bold text-gray-900">{{ $news->title }}</a>
    </div>
</div>
