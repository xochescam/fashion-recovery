<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewFollower extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $follower;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $follower)
    {
        $this->user     = $user;
        $this->follower = $follower;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('¡Tienes un nuevo seguidor!')
                    ->view('emails.follower.new')
                    ->with([
                        'AliasSeller' => $this->user->Alias,
                        'AliasFollower'   => $this->follower->Alias,
                    ]);

    }
}
