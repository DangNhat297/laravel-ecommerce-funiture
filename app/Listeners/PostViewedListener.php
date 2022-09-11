<?php

namespace App\Listeners;

use App\Events\PostViewedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostViewedListener
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
     * @param  \App\Events\PostViewed  $event
     * @return void
     */
    public function handle(PostViewedEvent $event)
    {
        $post = $event->post;
        $post->increment('view');
        $post->save();
    }
}
