<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('thumbnail')->paginate(10);     
        return view('screen.admin.product.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('screen.admin.product.create', [
            'categories'    => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        return redirect()
                    ->back()
                    ->withInput();
    }

    public function edit(Product $product)
    {
        // dd($product->hasAttr());
        $product = $product->load(['attributes', 'categories', 'images']);
        $categories = Category::all();
        return view('screen.admin.product.create', [
            'product'   => $product,
            'categories'=> $categories
        ]);
        // foreach($product->load('attributes')->attributes as $attr){
        //     echo $attr->name.' => '.$attr->pivot->value . '<br/>';
        // }
    }

    public function destroy(Product $product)
    {
        $result = $product->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa sản phẩm thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
