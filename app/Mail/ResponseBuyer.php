<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseBuyer extends Mailable
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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item,$rason,$type)
    {
        $this->item = $item;
        $this->rason = $rason;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Respuesta de solicitud de devolución')
                    ->view('emails.return.response-buyer')
                    ->with([
                        'item'    => $this->item,
                        'type'    => $this->type,
                        'rason'   => $this->rason,
                        'string'  => str_random(255)
                    ]);

    }
}
