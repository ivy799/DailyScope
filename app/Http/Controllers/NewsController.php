<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {

        return view('news.index', [
            'categories' => Category::whereHas('news')->take(10)->get()
        ]);
    }

    public function show(News $news)
    {
        return view('news.show', [
            'news' => $news
        ]);
    }
}
