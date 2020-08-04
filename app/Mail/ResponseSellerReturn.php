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
    protected $item;
    protected $rason;
    protected $type;
    protected $comment;
    protected $return;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item,$rason,$type,$comment,$return)
    {
        $this->item = $item;
        $this->rason = $rason;
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
                    ->view('emails.return.response-seller-return')
                    ->with([
                        'item'     => $this->item,
                        'rason'    => $this->rason,
                        'type'     => $this->type,
                        'comments' => $this->comment,
                        'return'   => $this->return,
                        'string'   => str_random(255)
                    ]);

    }
}
