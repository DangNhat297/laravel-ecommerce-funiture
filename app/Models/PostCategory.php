<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'categories_post';

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'parent_id',
        'status'	
    ];

    public function childs(){
        return $this->hasMany(PostCategory::class, 'parent_id', 'id');
    }

    public function posts(){
        return $this->belongsToMany(Post::class, 'post_categories', 'category_id', 'post_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($cat) {
            //  $cat->childs()->delete();
            foreach($cat->childs as $child){
                $child->parent_id = 0;
                $child->save();
            }

             // check product has one or many category
            foreach($cat->posts as $post){
                if($post->categories->count() == 1){
                    $newCat = PostCategory::where('id', '!=', $cat->id)->pluck('id')->shuffle()->first();
                    $post->categories()->sync($newCat);
                }
            }
        });
    }
}
