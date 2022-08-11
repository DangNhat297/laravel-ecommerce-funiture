<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'address',
        'email',
        'phone',
        'note',
        'status',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class ,'order_details', 'order_id', 'product_id')
            ->withTimestamps()->withPivot(['quantity','price','options']);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
