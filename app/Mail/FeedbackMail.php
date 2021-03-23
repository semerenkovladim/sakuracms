<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order_id;
    public $username;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id, $username, $status)
    {
        $this->order_id = $order_id;
        $this->username = $username;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.feedback');
    }
}
