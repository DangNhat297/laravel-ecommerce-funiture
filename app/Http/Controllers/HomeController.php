<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    
    public function index(){
        $sliders = Slider::orderBy('sort', 'ASC')->get();
        $productSales = Product::with(['thumbnail', 'attributes'])
                                ->where('published', 1)
                                ->where('promotion', '>', 0)
                                ->orderBy('id', 'DESC')
                                ->limit(8)
                                ->get();
        $newProducts = Product::with(['thumbnail', 'attributes'])
                                ->where('published', 1)
                                ->orderBy('id', 'DESC')
                                ->limit(8)
                                ->get();
        $mostView = Product::with(['thumbnail', 'attributes'])
                            ->where('published', 1)
                            ->orderBy('view', 'DESC')
                            ->limit(8)
                            ->get();
        $posts = Post::where('published', 1)
                        ->orderBy('id', 'DESC')
                        ->limit(3)
                        ->get();
        return view('screen.client.home', compact('sliders', 'newProducts', 'productSales', 'mostView', 'posts'));
    }

}
