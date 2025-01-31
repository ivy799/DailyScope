@props(['news'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a href="">
                <img class="mw-100 mx-auto rounded-xl" src="{{ $news->getThumbnailImage() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <img class="w-7 h-7 rounded-full mr-3" src="{{ $news->author->profile_photo_url }}" alt="avatar">
                <span class="mr-1 text-xs">{{ $news->author->name }}</span>
                <span class="text-gray-500 text-xs">. {{ $news->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a href="http://127.0.0.1:8000/blog/first%20post">
                    {{ $news->title }}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{ $news->getExcerptAttribute() }}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                <div class="flex gap-5">
                    @foreach ($news->category as $category)
                        <x-badge wire:navigate href="{{ route('news.index', ['category' => $category->title]) }}" text_color='{{ $category->text_color }}'
                            bg_color='{{ $category->bg_color }}'>{{ $category->title }}</x-badge>
                    @endforeach
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500 text-sm">{{ $news->readingTime() }} min read</span>
                    </div>
                </div>

                <div>
                    <livewire:like-button :key="$news->id" :$news />
                </div>
            </div>
        </div>
    </div>
</article>
