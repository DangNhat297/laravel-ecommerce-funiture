<?php

namespace App\Http\Controllers;

use App\Events\ProductViewedEvent;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    
    public function index($slug, $id){
        $product = Product::with(['reviews', 'images', 'attributes', 'categories'])->where('id', $id)->first();

        if(!$product || $product->published == 0) abort(404);

        event(new ProductViewedEvent($product));

        $relatedProducts = Product::whereHas('categories', function($q) use ($product){
            $q->whereIn('id', $product->categories->pluck('id')->toArray());
        })->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get();

        return view('screen.client.product-detail', compact('product', 'relatedProducts'));
    }

    public function review(ReviewRequest $request, $slug, $id)
    {
        $product = Product::find($id);
        try{
            $review = new Review();
            if(Auth::check()){
                $review->name = Auth::user()->fullname;
                $review->email = Auth::user()->email;
                $review->user_id = Auth::user()->id;
            } else {
                $review->name = $request->name;
                $review->email = $request->email;
            }
            $review->rating = $request->rating;
            $review->product_id = $product->id;
            $review->message = $request->message;
            $review->save();
            return redirect()
                        ->back()
                        ->with('success', 'Gửi đánh giá thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
