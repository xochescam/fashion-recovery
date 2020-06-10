<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Error extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $exception;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $exception)
    {
        $this->user      = $user;
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Error en Fashion Recovery')
                    ->view('emails.error')
                    ->with([
                        'exception' => $this->exception,
                        'user'      => $this->user,
                        'string' => str_random(255)
                    ]);
    }
}