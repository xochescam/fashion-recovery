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
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $answerUser, $answer, $type)
    {
        $this->user       = $user;
        $this->answerUser = $answerUser;
        $this->answer     = $answer;
        $this->type       = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->type == 'answer' ?
                    'El vendedor ha contestado tu pregunta.' :
                    'El usuario te contestado.';

        return $this->subject($subject)
                    ->view('emails.question.answer')
                    ->with([
                        'AliasSeller' => $this->user->Alias,
                        'AliasAnswer' => $this->answerUser->Alias,
                        'Answer'      => $this->answer->Question,
                        'AnswerID'    => $this->answer->ParentID,
                        'Type'        => $this->type
                    ]);
    }
}