<?php

namespace App\Http\Controllers;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    
    public function index(){
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
        if(count($carts) == 0){
            return view('screen.client.cart-empty');
        }
        return view('screen.client.checkout');
    }

    public function store(CheckoutRequest $request){
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
        $address = array_reverse($request->address);
        $address = implode(" - ", array_filter($address));
        
        DB::beginTransaction();

        try{
            $order = Order::create([
                'fullname'  => $request->fullname,
                'address'   => $address,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'note'      => $request->note,
                'status'    => 1,
                'user_id'   => Auth::user()->id ?? null
            ]);
            foreach($carts as $product){
                $order->products()->attach($product['product_id'], [
                    'options'   => $product['options'],
                    'quantity'  => $product['quantity'],
                    'price'     => $product['price']
                ]);
                $p = Product::find($product['product_id']);
                $p->quantity = $p->quantity - $product['quantity'];
                $p->save();
            }
            if(Auth::check()){
                Cart::where('user_id', Auth::user()->id)->delete();
            } else {
                Cookie::queue(Cookie::forget('carts'));
            }
            DB::commit();
            return view('screen.client.order-success')
                        ->with('success', 'Tạo đơn hàng thành công')
                        ->with('address', $address)
                        ->with('email', $request->email)
                        ->with('phone', $request->phone)
                        ->with('fullname', $request->fullname)
                        ->with('order_id', base64_encode('donhang_' . $order->id));
        }catch(\Exception $e){
            Log::error($e->getLine() . "\nLine: " . $e->getMessage());
            DB::rollBack();
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
