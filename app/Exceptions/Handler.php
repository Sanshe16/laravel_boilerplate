<?php

namespace App\Exceptions;

use Throwable;
use App\Support\ExceptionFormat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponsesTrait;
use App\Exceptions\Traits\ApiExceptionHandlerTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiExceptionHandlerTrait, ApiResponsesTrait;
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

                if ($exception instanceof InvalidRoleException)
                {
                    if (Auth::check())
                    {
                        return redirect(route('login'))->with(Auth::logout());
                    }
                    else
                    {
                        return redirect(route('login'));
                    }
                }
            }

            return parent::render($request, $exception);
        });
    }
}
