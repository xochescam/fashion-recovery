<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SoldItem extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $order;
    protected $items;
    protected $address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $items, $address)
    {
        $this->user  = $user;
        $this->order = $order;
        $this->items = $items;
        $this->address = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('¡Gracias por tu compra!')
                    ->view('emails.sold')
                    ->with([
                        'items' => $this->items,
                        'Alias'   => $this->user->Alias,
                        'address' => $this->address,
                        'Total' => $this->order->TotalAmount,
                        'Envio' => $this->order->ShippingAmount,
                        'Sum' => $this->order->TotalAmount + $this->order->ShippingAmount,
                        'string' => str_random(255)
                    ]);
    }
}