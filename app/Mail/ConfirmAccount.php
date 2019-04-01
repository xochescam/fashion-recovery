<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $beSeller;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $beSeller)
    {
        $this->user     = $user;
        $this->beSeller = $beSeller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de cuenta Fashion Recovery')
                    ->view('emails.account.confirm')
                    ->with([
                        'UserID' => $this->user->id,
                        'name'   => $this->user->Name,
                        'beSeller' => $this->beSeller,
                    ]);

    }
}
