<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="">
            @if ($this->search)
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Search Results for "{{ $this->search }}"</h3>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="py-4 {{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500 ' }}" wire:click = "setSort('desc')">Latest</button>
            <button class="py-4 {{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500 ' }}" wire:click = "setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->news as $item)
            <x-news.news-item :news='$item' />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->news->onEachSide(1)->links() }}
    </div>
</div>