<?php

namespace App\Exceptions\Traits;

use BadMethodCallException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


trait ApiExceptionHandlerTrait
{
    public function HandleApiException($request, $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException)
        {
            return $this->methodNotAllowedResponse([], $exception->getMessage());
        }

        elseif ($exception instanceof UnauthorizedException || $exception instanceof AuthorizationException || $exception instanceof AccessDeniedHttpException)
        {
            $this->forbiddenResponse([], __('You are not authorized to perform this action'));
        }

        elseif ($exception instanceof QueryException || $exception instanceof HttpResponseException || $exception instanceof HttpException)
        {
            $this->serverErrorResponse([], __('An error occurred while processing your request. Please try again later'));
        }

        elseif ($exception instanceof AuthenticationException)
        {
            $this->unauthorizedResponse([], __('You are not authenticated. Please log in to access this resource'));
        }

        elseif ($exception instanceof BadRequestHttpException)
        {
            $this->badRequestResponse([], __('The server cannot process the request due to a client error'));
        }

        elseif ($exception instanceof ValidationException)
        {
            $this->unprocessableResponse(['errors' => $exception->validator->getMessageBag()], __('Input validation failed. Please check your input and try again'));
        }

        elseif ($exception instanceof NotFoundHttpException)
        {
            $this->notFoundResponse([], __('Resource not found. Please verify the URL and try again'));
        }

        elseif ($exception instanceof ModelNotFoundException)
        {
            $this->notFoundResponse([], 'Model "' . $exception->getModel() . '" not found');
        }

        elseif ($exception instanceof BadMethodCallException)
        {
            $this->serverErrorResponse([], __('An unexpected error occurred. Please contact support for assistance'));
        }

        else
        {
            $this->errorResponse([], $exception->getMessage(), isValidHttpStatus($exception->getCode()) ? $exception->getCode() : 500);
        }
    }
}