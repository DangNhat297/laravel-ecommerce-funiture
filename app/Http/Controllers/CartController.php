<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    
    public function index(Request $request){
        if($request->ajax()){
            $carts = CartService::getCart();
            $carts['list'] = array_map(function($item){
                $item['price'] = productPrice($item['price']);
                $item['subtotal'] = productPrice($item['subtotal']);
                return $item;
            }, $carts['list']);
            return response()->json([
                'data'      => array_values($carts['list']),
                'total'     => productPrice($carts['total']),
                'message'   => 'Get Cart Success',
                'status'    => true
            ], 200);
        }
        return view('screen.client.cart');
    }

    public function store(Product $product, Request $request)
    {
        try{
            CartService::addCart($product, $request);
            return response()->json([
                'message' => 'Add product to cart success',
                'status'  => true
            ], 201);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status' => false], 201);
        }
    }

    public function update($id, Request $request)
    {
        try{
            CartService::updateCart($id, $request);
            return response()->json([
                'status' => true,
                'message' => 'update cart success'
            ]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status' => false]);
        }
    }

    public function destroy($id){
        try{
            CartService::deleteItem($id);
            return response()->json([
                'status' => true,
                'message' => 'update cart success'
            ]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function clearCart()
    {
        try{
            CartService::clearCart();
            return response()->json([
                'status' => true
            ]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'status' => false
            ]);
        }
    }

}
