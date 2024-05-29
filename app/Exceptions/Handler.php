<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // function render($request, Throwable $exception)
    // {
    //     if ($this->isHttpException($exception)) {
    //         $error = [] ;
    //         if ($exception->getStatusCode() == 404) {
    //             $error =  [
    //                 'title' => 'page not found',
    //                 'message' => "we are sorry, but the page you requested was not found",
    //                 'codeStatus' => (string)$exception->getStatusCode(),
    //             ];
    //         }
    //         if ($exception->getStatusCode() == 403) {
    //             $error =  [
    //                 'title' => 'Forbidden',
    //                 'message' => "You don't have the right roles to access this page!",
    //                 'codeStatus' => (string)$exception->getStatusCode(),
    //             ];
    //         }
    //         if ($exception->getStatusCode() == 500) {
    //             $error =  [
    //                 'title' => 'Server Error',
    //                 'message' => "Internal Server Error, Something is wrong!",
    //                 'codeStatus' => (string)$exception->getStatusCode(),
    //             ];
    //         }
    //         return response()->view('errors.index', $error);
    //     }
    //     return parent::render($request, $exception);
    // }
}
