<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class NewsComment extends Component
{
    use WithPagination;

    public News $news;

    #[Rule('required|string|min:3|max:255')]
    public String $comment;

    #[Computed()]
    public function comments(){
        return $this->news->comments()->latest()->paginate(3);
    }

    public function submitComment(){
        if(auth()->guest()){
            return redirect()->route('login');
        }
        $this->validate();

        $this->news->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $this->comment,
        ]);

        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.news-comment');
    }
}
