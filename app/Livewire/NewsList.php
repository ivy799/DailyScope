<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;
    
    #[Url()]
    public $sort = 'desc';
    
    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    public function setSort($sort){
        $this->sort = ($sort == 'desc') ? 'desc' : 'asc';
        $this->resetPage();
    }

    #[On('search')]
    public function updatedSearch($search){
        $this->search = $search;
    }

    #[Computed()]
    public function news(){
        return News::published()
        ->orderBy('published_at', $this->sort)
        ->when(Category::where('slug', $this->category)->first(), function($query){
            $query->withCategory($this->category);
        })
        ->where('title', 'like', "%{$this->search}%")
        ->simplePaginate(5);
    }
    
    public function render()
    {
        return view('livewire.news-list');
    }
}
