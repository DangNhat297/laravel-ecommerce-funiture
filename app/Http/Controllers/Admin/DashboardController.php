<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $categoryCount = Category::count();
        $productCount = Product::count();
        $reviewCount = Review::count();
        $userCount = User::count();
        $postCount = Post::count();
        $orderCount = Order::count();
        $orders = Order::with('orderDetails')->get();
        $revenue = 0;
        $orders->map(function($order) use (&$revenue){
            $order->orderDetails->sum(function($q) use (&$revenue){
                $revenue += $q->quantity*$q->price;
            });
        });
        return view('screen.admin.dashboard', compact('categoryCount', 'productCount', 'reviewCount', 'userCount', 'postCount', 'orderCount', 'revenue'));
    }


}
