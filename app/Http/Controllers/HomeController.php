<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'featuredPosts' => News::published()->featured()->latest('published_at')->take(3)->get(),
            'latestPosts' => News::published()->latest('published_at')->take(9)->get(),
        ]);
    }
}
