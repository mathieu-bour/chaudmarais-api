<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Mathrix\Lumen\Zero\Exceptions\Http\Http404NotFoundException;
use Mathrix\Lumen\Zero\Exceptions\Http\HttpException as MathrixHTTPException;
use Mathrix\Lumen\Zero\Exceptions\ValidationException;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     *
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     *
     * @return Response|JsonResponse
     * @throws Http404NotFoundException
     * @throws ValidationException
     * @throws ReflectionException
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof MathrixHTTPException) {
            return $exception->toJsonResponse();
        } else if ($exception instanceof NotFoundHttpException) {
            throw new Http404NotFoundException([], null, $exception);
        } else if ($exception instanceof IlluminateValidationException) {
            $a = $exception->validator->errors();
            throw new ValidationException($a, null, $exception);
        }

        $exceptionClass = (new ReflectionClass($exception))->getShortName(); // Get the Exception class name

        // Default exception handler
        $error = Str::snake($exceptionClass, "_");
        $error = str_replace("_exception", "", $error);

        $json = [
            "error" => $error,
            "message" => $exception->getMessage(),
        ];

        if (!app()->environment("master")) {
            $json["debug"] = [
                "exception" => get_class($exception),
                "trace" => explode("\n", $exception->getTraceAsString())
            ];

            if ($exception->getPrevious() instanceof Exception) {
                $previous = $exception->getPrevious();
                $json["debug"]["previous"] = [
                    "exception" => get_class($previous),
                    "trace" => explode("\n", $previous->getTraceAsString())
                ];
            }
        }

        $rendered = parent::render($request, $exception);

        return new JsonResponse($json, $rendered->getStatusCode());
    }
}
