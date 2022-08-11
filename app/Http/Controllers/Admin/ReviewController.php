<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    public function index()
    {
        $products = Product::withCount('reviews')->has('reviews', '>', 0)->get();
        return view('screen.admin.review.list', compact('products'));
    }

    public function detail($id)
    {
        $reviews = Review::where('product_id', $id)->get();
        return view('screen.admin.review.detail', compact('reviews'));
    }

    public function destroy($id){
        $result = Review::find($id)->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa đánh giá thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
