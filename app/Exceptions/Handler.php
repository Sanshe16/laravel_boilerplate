<?php

namespace App\Exceptions;

use Throwable;
use App\Exceptions\Traits\ApiExceptionHandlerTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiExceptionHandlerTrait;
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
        $this->reportable(function (Throwable $exception)
        {
            //
        });

        $this->renderable(function (Throwable $exception, $request)
        {
            if ($request->wantsJson() || isApiCall($request) || $request->ajax())
            {
                $this->HandleApiException($request, $exception);
            }
            else
            {
                showNotyf($exception->getMessage(), 'error');
                // return redirect()->back();
            }
        });
    }
}