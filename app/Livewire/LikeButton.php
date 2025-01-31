<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\News;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{

    public News $news;

    // public function mount(News $news)
    // {
    //     $this->news = $news;
    // }
    
    public function toggleLike() {
        if(Auth::guest()){
            return $this->redirect(route('login'),true);
        }

        $user = Auth::user();

        if($user->hasLiked($this->news)){
            $user->likes()->detach($this->news);
            return;
        }   
        $user->likes()->attach($this->news);

    }
    
    public function render()
    {
        return view('livewire.like-button');
    }
}
