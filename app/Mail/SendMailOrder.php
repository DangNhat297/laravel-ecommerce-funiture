<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $order, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $subject)
    {
        $this->order    = $order;
        $this->subject  = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-confirm')->subject($this->subject);
    }
}
