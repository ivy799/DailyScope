<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $featuredPosts = Cache::remember('featuredPosts', Carbon::now()->addHour(5), function(){
            return News::published()->featured()->with('category')->latest('published_at')->take(3)->get();
        });

        $latestPosts = Cache::remember('latestPosts', Carbon::now()->addHour(5), function(){
            return News::published()->with('category')->latest('published_at')->take(3)->get();
        });

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
