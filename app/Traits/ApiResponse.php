<?php

namespace App\Traits;

use App\Exceptions\BadLoginCredentialException;
use App\Exceptions\ResourceAlreadyExistsException;
use App\Exceptions\SomethingWentWrongException;
use App\Exceptions\UserNotActiveException;
use App\Http\Controllers\Api\ApiBaseController;
use BadMethodCallException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success(string $message = null, int $responseCode = 200, $payload = null,)
    {
        return response()->json([
            'responseCode' => $responseCode,
            'status' => 'Success',
            'message' => $message,
            'payload' => $payload
        ], $responseCode);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $responseCode, $payload = null)
    {
        return response()->json([
            'responseCode' => $responseCode,
            'status' => 'Error',
            'message' => $message,
            'payload' => $payload
        ], $responseCode);
    }


    public static function createJson(string $message = null,  int $responseCode = 200, $status = 'Success', $payload = null)
    {
        return response()->json([
            'responseCode' => $responseCode,
            'status' => 'Success',
            'message' => $message,
            'payload' => $payload
        ], $responseCode);
    }

    function verifyRequiredParams($required_fields, $request_params)
    {
        $error = false;
        $error_fields = array();

        foreach ($required_fields as $field) {
            if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
                $error = true;
                $error_fields[] = $field;
            }
        }
        if ($error) {
            // Required field(s) are missing or empty
            return array(
                'success' => false,
                'message' => 'Required field(s) ' . implode(', ', $error_fields) . ' missing or empty'
            );
        }

        // return appropriate response when successful?
        return array(
            'success' => true,
            'message' => ''
        );
    }

    function createInternalErrorResponse($message = __('Internal server error'), $payload = null)
    {
        return self::createJson($message, 500, "Error", $payload);
    }

    function createBadResponse($message = __('Bad request'), $payload = null)
    {
        return self::createJson($message, 400, "Error", $payload);
    }

    function createValidResponseNotFound($message = __('Not Found'), $payload = null)
    {
        return self::createJson($message, 404, "Error", $payload);
    }
    function createValidResponseAlreadyExists($message = __('Already Exists'), $payload = null)
    {
        return self::createJson($message, 409, "Error", $payload);
    }


    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    function createAuthenticationException(AuthenticationException $exception, $payload = null)
    {
        return self::createJson('You are not authenticated' . ' ' . $exception->getMessage(), 401, 'Error', $payload);
    }

    /**
     * @param \Illuminate\Database\Eloquent\ModelNotFoundException $exception
     *
     * @return \Illuminate\Http\Response
     */
    private function createModelNotFoundException(ModelNotFoundException $exception, $payload = null)
    {
        return self::createJson('Model resource for ' . $exception->getModel() . ' not found' . ' ' . $exception->getMessage(), 404, 'Error', $payload);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    private function BadMethodCallException(BadMethodCallException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage(), 404, 'Error', $payload);
    }

    /**
     * @param \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $exception
     *
     * @return \Illuminate\Http\Response
     */
    private function MethodNotAllowedHttpException(MethodNotAllowedHttpException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage() . ' Methods does not found', 405, 'Error', $payload);
    }

    private function UnauthorizedException(UnauthorizedException $exception, $payload = null)
    {
        return self::createJson('You do not have proper permission to perform this task' . ' ' . $exception->getMessage(), 403, 'Error', $payload);
    }

    private function AuthorizationException(AuthorizationException $exception, $payload = null)
    {
        return self::createJson('You do not have proper permission to perform this task' . ' ' . $exception->getMessage(), 403, 'Error', $payload);
    }
    private function AccessDeniedHttpException(AccessDeniedHttpException $exception, $payload = null)
    {
        return self::createJson('You do not have proper permission to perform this task' . ' ' . $exception->getMessage(), 403, 'Error', $payload);
    }

    private function UserNotActiveException(UserNotActiveException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage() . ' ' . 'Please check if your account is properly activated', 401, 'Error', $payload);
    }

    private function BadLoginCredentialException(BadLoginCredentialException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage() . ' ' . 'Please check the login credentials', 401, 'Error', $payload);
    }

    private function SomethingWentWrongException(SomethingWentWrongException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage() . ' ' . 'Something may have gone wrong, please try again', 401, 'Error', $payload);
    }

    private function ResourceAlreadyExistsException(ResourceAlreadyExistsException $exception, $payload = null)
    {
        return self::createJson($payload, 409, $exception->getMessage() . ' ' . 'Please check your payload data again', false);
    }

    private function QueryException(QueryException $exception, $payload = ['success' => false, 'data' => null])
    {
        return self::createJson($exception->getMessage() . ' ' . 'Please check your payload data again', 409, 'Error', $payload);
    }

    private function BadRequestHttpException(BadRequestHttpException $exception, $payload = null)
    {
        return self::createJson($exception->getMessage() . ' ' . 'Please check your payload data again', 400, 'Error', $payload);
    }
    private function NotFoundHttpException($exception, $payload = null)
    {
        return self::createJson($payload, 404, $exception->getMessage() . 'Not Found', false);
        return self::createJson($exception->getMessage() . 'Not Found', 404, 'Error', $payload);
    }
}
