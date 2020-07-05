<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseReturn extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $comment;
    protected $return;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment,$return)
    {
        $this->comment = $comment;
        $this->return = $return;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Respuesta de proceso de devolución')
                    ->view('emails.return.response-return')
                    ->with([
                        'comment' => $this->comment,
                        'return' => $this->return,
                        'string'  => str_random(255)
                    ]);

    }
}
