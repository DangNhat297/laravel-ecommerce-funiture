<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::with('orderDetails')->get();
        return view('screen.admin.order.list', compact('orders'));
    }

    public function detail($order)
    {
        $order = Order::with(['orderDetails' => function($q){
            $q->with(['product' => function($q){
                $q->with('thumbnail');
            }]);
        }])->where('id', $order)->first();
        return view('screen.admin.order.detail', compact('order'));
    }

    public function update(Order $order, Request $request){
        try{
            $order->status = $request->status;
            $order->save();
            return response()->json([
                'status' => true,
                'message'=> 'update order success'
            ]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status' => false]);
        }
    }

    public function destroy(Order $order)
    {
        try{
            $result = $order->delete();
            if($result){
                return redirect()
                        ->back()
                        ->with('success', 'Xóa đơn hàng thành công');
            }
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
