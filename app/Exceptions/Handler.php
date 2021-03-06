<?php

namespace App\Exceptions;

use http\Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if($this->isHttpException($exception)){
            $code = $exception->getStatusCode();
            $message = $exception->getMessage();
            switch ($code){
                case 403:
                    return \Response::view('errors.403',compact('message','code'),403);
                    break;
                case 404:
                    return \Response::view('errors.404',compact('message','code'),404);
                    break;
            }
        }  else {
            return parent::render($request, $exception);
        }
        return parent::render($request, $exception);
    }
}
