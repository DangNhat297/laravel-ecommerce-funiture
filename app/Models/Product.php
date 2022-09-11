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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // public function thumbnail(){
    //     return $this->hasOne(ProductImage::class);
    // }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values', 'product_id', 'attribute_id')->withPivot('value');
    }

    public function hasAttr()
    {
        return (bool)$this->attributes()->count();
    }

    public function showAttributes()
    {
        $arr = [];
        foreach ($this->attributes()->get() as $value) {
            if (!in_array($value->name, $arr)) {
                $arr[$value->name]['id'] = $value->id;
                $arr[$value->name]['value'][] = $value->pivot->value;
            } else {
                $arr[$value->name]['value'][] = $value->pivot->value;
            }
        }
        return $arr;
    }

    // scope filter
    public function scopeSortBy($query, $request)
    {
        if ($request->query('sort') == 'azSort') {
            $query->orderBy('name');
        } elseif ($request->query('sort') == 'zaSort') {
            $query->orderByDesc('name');
        } elseif ($request->query('sort') == 'lPrice') {
            $query->orderBy('price');
        } elseif ($request->query('sort') == 'hPrice') {
            $query->orderByDesc('price');
        } elseif ($request->query('sort') == 'default') {
            $query->orderBy('id', 'DESC');
        } elseif ($request->query('sort') == 'view') {
            $query->orderBy('view', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }
    }

    public function scopeFindName($query, $request)
    {
        if($request->query('q')){
            $query->where('name', 'like', '%'. $request->query('q') .'%');
        }
    }

    public function scopeFindByCategories($query, $request)
    {
        if($request->query('categories')){
            $cats = explode(",", $request->query('categories'));
            return $query->whereHas('categories', function($q) use ($cats){
                $q->whereIn('slug', $cats);
            });
        }
    }

    public function scopeFindBySizes($query, $request)
    {
        if($request->query('kich-thuoc')){
            $sizes = explode(",", $request->query('kich-thuoc'));
            return $query->whereHas('attributes', function($q) use ($sizes){
                $q->whereIn('value', $sizes);
            });
        }
    }

    public function scopeFindByColors($query, $request)
    {
        if($request->query('mau-sac')){
            $colors = explode(",", $request->query('mau-sac'));
            return $query->whereHas('attributes', function($q) use ($colors){
                $q->whereIn('value', $colors);
            });
        }
    }


}
