<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
class CartService {

    public static function getCart()
    {
        $total = 0;
        if(Auth::check()){
            $carts = Cart::with('product:products.id,products.name,products.slug,products.price,products.promotion')
                    ->where('user_id', Auth::user()->id)
                    ->get()
                    ->map(function(Cart $cart) use (&$total){
                        $cart->thumb = $cart->product->thumbnail->path;
                        $cart->product->makeHidden('thumbnail');
                        $cart->price = $cart->product->promotion > 0 ? $cart->product->promotion : $cart->product->price;
                        $cart->subtotal = $cart->product->promotion > 0 ? $cart->product->promotion*$cart->quantity : $cart->product->price*$cart->quantity;
                        $total += $cart->product->promotion > 0 ? $cart->product->promotion*$cart->quantity : $cart->product->price*$cart->quantity;
                        return $cart; 
                    })
                    ->toArray();
        } else {
            // return response()->json(['ok']);
            $carts = Cookie::get('carts') ?? "[]";
            $carts = json_decode($carts, true);
            $carts = array_map(function($key, $item) use (&$total, &$carts){
                $product = Product::select('id', 'name', 'slug', 'price', 'promotion')->where('id', $item['product_id'])->first();
                if(!$product){
                    unset($carts[$key]);
                    return null;
                }
                $item['id'] = $key;
                $item['product'] = $product->toArray();
                $item['thumb'] = $product->thumbnail->path;
                $item['price'] = $product->promotion > 0 ? $product->promotion : $product->price;
                $item['subtotal'] = ($product->promotion > 0) ? $product->promotion*$item['quantity'] : $product->price*$item['quantity'];
                $total += ($product->promotion > 0) ? $product->promotion*$item['quantity'] : $product->price*$item['quantity'];
                return $item;
            }, array_keys($carts), $carts);
            // dd($carts);
            $carts = (array)array_filter($carts);
        }
        return [
            'total' => $total,
            'list' => $carts
        ];
    }

    public static function addCart($product, $request)
    {
        $key = base64_encode($product->id.'-'.$request->options);
        
        if(Auth::check()){
            $userID = Auth::user()->id;
            $cart = Cart::where('user_id', $userID)
                            ->where('product_id', $product->id)
                            ->where('options', $request->options)
                            ->first();
            if($cart){
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->user_id = $userID;
                $cart->options = $request->options;
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        } 
        
        $carts = Cookie::get('carts') ?? "[]";
        $carts = (array)json_decode($carts, true);
        if(isset($carts[$key])){
            $carts[$key]['quantity'] += $request->quantity;
        } else {
            $carts[$key] = [
                'product_id'    => $product->id,
                'options'       => $request->options,
                'quantity'      => $request->quantity,
            ];
        }

        Cookie::queue('carts', json_encode($carts), 3600 * 336); // 2 week
        // cookie()->queue(cookie('carts', json_encode($carts), 3600 * 336));
    }

    public static function updateCart($id, $request)
    {
        if(Auth::check()){
            $cart = Cart::find($id);
            $cart->quantity = $request->quantity;
            $cart->save();
        } else {
            $carts = Cookie::get('carts') ?? "[]";
            $carts = json_decode($carts, true);
            $carts[$id]['quantity'] = $request->quantity;
            Cookie::queue('carts', json_encode($carts), 3600 * 336); // 2 week
        }
    }

    public static function deleteItem($id)
    {
        if(Auth::check()){
            $cart = Cart::find($id);
            $cart->delete();
        } else {
            $carts = Cookie::get('carts') ?? "[]";
            $carts = json_decode($carts, true);
            unset($carts[$id]);
            Cookie::queue('carts', json_encode($carts), 3600 * 336); // 2 week
        }
    }

    public static function clearCart()
    {
        if(Auth::check()){
            Cart::where('user_id', Auth::user()->id)->delete();
        } else {
            Cookie::queue(Cookie::forget('carts'));
        }
    }

}