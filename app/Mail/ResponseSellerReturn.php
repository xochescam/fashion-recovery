<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseSellerReturn extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $type;
    protected $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$comment)
    {
        $this->type = $type;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Respuesta de solicitud de devolución')
                    ->view('emails.return.response-seller-return')
                    ->with([
                        'type'    => $this->type,
                        'comments' => $this->comment,
                        'string'  => str_random(255)
                    ]);

    }
}
