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

    #[Url()]
    public $popular = false;

    public function setSort($sort){
        $this->sort = ($sort == 'desc') ? 'desc' : 'asc';
        $this->resetPage();
    }

    #[On('search')]
    public function updatedSearch($search){
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed()]
    public function news(){
        return News::published()
        ->with('author','category')
        ->when($this->activeCategory, function($query){
            $query->withCategory($this->category);
        })
        ->when($this->popular, function($query){
            $query->popular();
        })
        ->search($this->search)
        ->orderBy('published_at', $this->sort)
        ->simplePaginate(5);
    }

    #[Computed()]
    public function activeCategory(){
        if($this->category === null || $this->category === ''){
            return null;
        }
        return Category::where('slug', $this->category)->first() ?? null;
    }
    

    public function clearFilters(){
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.news-list');
    }
}
