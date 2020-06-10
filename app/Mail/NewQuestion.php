<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewQuestion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $user;
    protected $questionUser;
    protected $question;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $questionUser, $question)
    {
        $this->user         = $user;
        $this->questionUser = $questionUser;
        $this->question     = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Un usuario te ha realizado una pregunta')
                    ->view('emails.question.new')
                    ->with([
                        'AliasSeller'   => $this->user->Alias,
                        'AliasQuestion' => $this->questionUser->Alias,
                        'Question'      => $this->question->Question,
                        'QuestionID'    => $this->question->QuestionID,
                        'string' => str_random(255)
                    ]);

    }
}
