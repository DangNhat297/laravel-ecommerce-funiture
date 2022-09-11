<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Product;

class ShopController extends Controller
{
    
    public function index(Request $request){
        // dd($request->all());
        $categories = Category::where('status', 1)->get();
        $attributes = Attribute::with('values')->get();
        $products = Product::with(['thumbnail'])
                            ->select('id', 'name', 'slug', 'price', 'promotion', 'quantity')
                            ->where('published', 1)
                            ->sortBy($request)
                            ->findName($request)
                            ->findByCategories($request)
                            ->findBySizes($request)
                            ->findByColors($request)
                            ->paginate(3);
        return view('screen.client.shop', compact('categories', 'attributes', 'products'));
    }

}
