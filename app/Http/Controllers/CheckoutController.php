<?php

namespace App\Http\Controllers;

use App\Events\OrderConfirmEvent;
use App\Http\Requests\CheckoutRequest;
use App\Http\Services\CartService;
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
        $carts = CartService::getCart();
        if(count($carts['list']) == 0){
            return view('screen.client.cart-empty');
        }
        return view('screen.client.checkout');
    }

    public function store(CheckoutRequest $request){
        $carts = CartService::getCart();
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
            foreach($carts['list'] as $product){
                $order->products()->attach($product['product_id'], [
                    'options'   => $product['options'],
                    'quantity'  => $product['quantity'],
                    'price'     => $product['price']
                ]);
                $p = Product::find($product['product_id']);
                $p->quantity = $p->quantity - $product['quantity'];
                $p->save();
            }
            event(new OrderConfirmEvent($order));
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
                        ->with('order_id', '#' . $order->id);
        }catch(\Exception $e){
            Log::error($e->getLine() . "\nLine: " . $e->getMessage());
            DB::rollBack();
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function track(Request $request)
    {
        if($request->query('id')){
            $id = $request->query('id');
            $id = str_replace('#', '', $id);
            $order = Order::findOrFail($id);
            $order->load(['orderDetails' => function($q){
                $q->with(['product' => function($q){
                    $q->with('thumbnail');
                }]);
            }]);
            // dd($order);
            return view('screen.client.track-order', compact('order'));
        }
        return view('screen.client.track-order');
    }

}
