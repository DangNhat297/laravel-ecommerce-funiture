<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    
    public function index()
    {
        $orders = Order::with('orderDetails')->where('user_id', auth()->user()->id)->get();
        return view('screen.client.profile', compact('orders'));
    }

    public function cancelOrder($id)
    {
        try{
            $order = Order::where('id', $id)
                            ->where('user_id', auth()->user()->id)
                            ->first();
            if(!$order) abort(404);
            $order->status = 0;
            $order->save();
            return redirect()->back();
        }catch(\Exception $e){
            Log::log($e->getMessage());
            return redirect()->back();
        }
    }

}
