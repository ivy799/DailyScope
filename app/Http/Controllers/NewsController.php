<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index()
    {

        $category = Cache::remember('category', Carbon::now()->addHour(5), function(){
            return Category::whereHas('news', function($query){
                $query->published();
            })->take(10)->get();
        });

        return view('news.index', [
            'categories' => $category,
        ]);
    }

    public function show(News $news)
    {
        return view('news.show', [
            'news' => $news
        ]);
    }
}
