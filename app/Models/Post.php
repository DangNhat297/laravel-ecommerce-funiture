<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'short_desc',
        'content',
        'published',
        'view',
        'user_id'
    ];

    public function categories(){
        return $this->belongsToMany(PostCategory::class, 'post_categories', 'post_id', 'category_id');
    }

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
