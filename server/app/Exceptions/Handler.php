<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof FormException) {
            return $this->jsonFormExceptionResponse($e);
        } else {
            return $this->jsonExceptionResponse($e);
        }
    }

    public function jsonFormExceptionResponse(FormException $e)
    {
        $data = [
            'error' => $e->getMessage(),
            'fields' => $e->getFieldErrors()
        ];

        return response()->json($data);
    }

    public function jsonExceptionResponse(\Exception $e)
    {
        $data = [
            'error' => $e->getMessage()
        ];

        return response()->json($data);
    }
}
