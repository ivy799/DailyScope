<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    public function scopePublished($query){
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query){
        return $query->where('featured', true);
    }
}
