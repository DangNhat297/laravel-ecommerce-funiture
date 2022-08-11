<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_desc',
        'slug',
        'content',
        'price',
        'promotion',
        'quantity',
        'published',
        'view'
    ];

    // protected $appends = [
    //     'thumbnail',
    //     'rating'
    // ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function getRatingAttribute(){
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function thumbnail(){
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // public function thumbnail(){
    //     return $this->hasOne(ProductImage::class);
    // }

    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'attribute_values', 'product_id', 'attribute_id')->withPivot('value');
    }

    public function hasAttr(){
        return (boolean)$this->attributes()->count();
    }

    public function showAttributes(){
        $arr = [];
        foreach($this->attributes()->get() as $value){
            if(!in_array($value->name, $arr)){
                $arr[$value->name]['id'] = $value->id;
                $arr[$value->name]['value'][] = $value->pivot->value;
            } else {
                $arr[$value->name]['value'][] = $value->pivot->value;
            }
        }
        return $arr;
    }
}
