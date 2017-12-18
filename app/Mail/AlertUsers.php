<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertUsers extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $cryptos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $cryptos)
    {
        $this->email = $email;
        $this->cryptos = $cryptos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.alerted');
    }
}
