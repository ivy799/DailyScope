<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'body',
        'published_at',
        'featured',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished($query){
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query){
        return $query->where('featured', true);
    }

    public function readingTime(){
        $words = round(str_word_count($this->body) / 250);
        return $words;
    }

    public function getExcerptAttribute(){
        return Str::limit(strip_tags($this->body, 150));
    }
}
