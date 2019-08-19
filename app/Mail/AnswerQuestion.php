<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnswerQuestion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $answerUser;
    protected $answer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $answerUser, $answer)
    {
        $this->user       = $user;
        $this->answerUser = $answerUser;
        $this->answer     = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('El vendedor ha contestado tu pregunta.')
                    ->view('emails.question.answer')
                    ->with([
                        'AliasSeller' => $this->user->Alias,
                        'AliasAnswer' => $this->answerUser->Alias,
                        'Answer'      => $this->answer->Question,
                        'AnswerID'    => $this->answer->ParentID,
                    ]);

    }
}
