<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\News;
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
        $hasLiked = $user->likes()->where('news_id', $this->news->id)->exists();

        if($hasLiked){
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
