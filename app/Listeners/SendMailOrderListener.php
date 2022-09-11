<?php

namespace App\Listeners;

use App\Events\OrderConfirmEvent;
use App\Mail\SendMailOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderConfirmEvent $event)
    {
        $order = $event->order->load('products');
        Mail::to(env('ADMIN_EMAIL'))
            ->send(new SendMailOrder($order, 'Bạn có đơn hàng mới trên Funiture Ecommerce'));
        Mail::to($order->email)
            ->send(new SendMailOrder($order, 'Đơn hàng của bạn đã được đặt thành công trên Funiture Ecommerce'));
    }
}
