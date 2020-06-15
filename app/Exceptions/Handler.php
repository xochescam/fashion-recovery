<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Mail\Error;
use App\Mail\ConfirmAccount;
use App\Mail\ErrorPackPack;
use Mail;
use Auth;
use Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        $user = isset(Auth::User()->id) ? Auth::User() : 'Sin usuario';

        if($exception->getCode() >= 400)
        {
            $host = $exception->getRequest()->getUri()->getHost();

            if($host == "pp-users-integrations-api-prod.herokuapp.com") {

                Mail::to('contacto@fashionrecovery.com.mx')
                ->send(new ErrorPackPack(json_decode($exception->getResponse()->getBody())));
            } 

            Mail::send('emails.error', ['e' => $exception], function($message)
            {
                $message->to('xochissea@gmail.com')->subject('Error en FR');
            });

            //dd($exception->getMessage());
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
