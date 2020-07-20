<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseBuyerReturn extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $type;
    protected $comment;
    protected $return;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$comment,$return)
    {
        $this->type = $type;
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
        return $this->subject('Respuesta de solicitud de devolución')
                    ->view('emails.return.response-buyer-return')
                    ->with([
                        'type'    => $this->type,
                        'comments' => $this->comment,
                        'return' => $this->return,
                        'string'  => str_random(255)
                    ]);

    }
}
