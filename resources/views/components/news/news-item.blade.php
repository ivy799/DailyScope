@props(['news'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{ route('news.show', $news->slug) }}">
                <img class="mw-100 mx-auto rounded-xl" src="{{ $news->getThumbnailImage() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <x-news.author :author="$news->author" size="sm"/>
                <span class="text-gray-500 text-xs">. {{ $news->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('news.show', $news->slug) }}">
                    {{ $news->title }}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{ $news->getExcerptAttribute() }}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                <div class="flex gap-5">
                    @foreach ($news->category as $category)
                        <x-news.category-badge :category="$category" />
                    @endforeach
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500 text-sm">{{ $news->readingTime() }} min read</span>
                    </div>
                </div>

                <div>
                    <livewire:like-button :key="'like-' . $news->id" :$news />
                </div>
            </div>
        </div>
    </div>
</article>
