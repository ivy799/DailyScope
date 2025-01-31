<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
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

    public function category(){
        return $this->belongsToMany(Category::class);
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

    public function scopeWithCategory($query, string $category){
        $query->whereHas('category', function($query) use ($category) {
            $query->where('slug', $category);
        });
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

    public function getThumbnailImage(){
        $isUrl = str_contains($this->image, 'http');
        return $isUrl ? $this->image : Storage::disk('public')->url($this->image);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'like_news')->withTimestamps();
    }
}
