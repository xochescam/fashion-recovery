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
    protected $type;
    protected $rason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$rason)
    {
        $this->type = $type;
        $this->rason = $rason;
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
                        'type'    => $this->type,
                        'rason'   => $this->rason,
                        'string'  => str_random(255)
                    ]);

    }
}
