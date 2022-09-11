<?php

namespace App\Listeners;

use App\Events\ProductViewedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductViewedListener
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
    public function handle(ProductViewedEvent $event)
    {
        $product = $event->product;
        $product->increment('view');
        $product->save();
    }
}
