<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseSeller extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $rason;
    protected $comments;
    protected $return;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rason,$comments,$return)
    {
        $this->rason = $rason;
        $this->comments = $comments;
        $this->return = $return;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('El comprador ha solicitado proceso de devolución')
                    ->view('emails.return.response-seller')
                    ->with([
                        'rason'   => $this->rason,
                        'comments'=> $this->comments,
                        'return'  => $this->return,
                        'string'  => str_random(255)
                    ]);

    }
}
