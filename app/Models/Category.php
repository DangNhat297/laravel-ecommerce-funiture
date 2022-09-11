<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'status'
    ];

    public function childs(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
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
            foreach($cat->products as $product){
                if($product->categories->count() == 1){
                    $newCat = Category::where('id', '!=', $cat->id)->pluck('id')->shuffle()->first();
                    $product->categories()->sync($newCat);
                }
            }
        });
    }
}
