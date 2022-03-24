<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \App\Exceptions\UnauthorizedException::class,
        \App\Exceptions\ForbidenException::class,
        \App\Exceptions\NotFoundException::class,
        \App\Exceptions\UnprocessableEntityException::class,
        \App\Exceptions\MysqlException::class,
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
        });

        $this->renderable(function (Throwable $e, Request $request) {
            $this->jwtHandler($e, $request);
            if ($request->expectsJson()) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                    return response()->json([
                        'code' => '99997',
                        'message' => 'route not found',
                        'data' => null,
                    ], 404);
                }
                if (get_class($e) === 'Error' && env('APP_ENV') == 'production') {
                    return response()->json([
                        'code' => '99999',
                        'message' => 'server error',
                        'data' => null,
                    ], 500);
                } else {
                    return response()->json([
                        'code' => '99999',
                        'message' => $e->getMessage(),
                        'data' => null,
                    ], 500);
                }
                if ($e instanceof \Illuminate\Database\QueryException && env('APP_ENV') == 'production') {
                    return response()->json([
                        'code' => '99998',
                        'message' => 'database error',
                        'data' => null,
                    ], 500);
                } else {
                    return response()->json([
                        'code' => '99998',
                        'message' => $e->getMessage(),
                        'data' => null,
                    ], 500);
                }
            }
        });
    }

    private function jwtHandler(Throwable $e, Request $request)
    {
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException
            || $e instanceof \Tymon\JWTAuth\Exceptions\PayloadException
            || $e instanceof \Tymon\JWTAuth\Exceptions\InvalidClaimException) {
            $data = [
                'module' => 'jwt',
                'errorType' => 'JWT_TOKEN_INVALID_EXCEPTION',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
            throw new UnauthorizedException($data);
        }
        if ($e instanceof \Tymon\JWTAuth\Exceptions\UserNotDefinedException) {
            $data = [
                'display' => [
                    'message' => $e->getMessage(),
                ],
                'module' => 'jwt',
                'errorType' => 'JWT_USER_NOT_FOUND',
            ];
            throw new UnauthorizedException($data);
        }
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            $data = [
                'display' => [
                    'message' => $e->getMessage(),
                ],
                'module' => 'jwt',
                'errorType' => 'JWT_TOKEN_EXPIRED',
            ];
            throw new UnauthorizedException($data);
        }
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
            || $e instanceof \Illuminate\Auth\AuthenticationException) {
            $data = [
                'display' => [
                    'message' => $e->getMessage(),
                ],
                'module' => 'jwt',
                'errorType' => 'JWT_UNAUTHORIZED',
            ];
            throw new UnauthorizedException($data);
        }
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
            $data = [
                'display' => [
                    'message' => $e->getMessage(),
                ],
                'module' => 'jwt',
                'errorType' => 'JWT_ACTION_FORBIDEN',
            ];
            throw new ForbidenException($data);
        }

        return $this->prepareJsonResponse($request, $e);
    }
}
