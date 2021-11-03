<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
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

        $this->renderable(function (ValidationException $ex, $request) {
            return response()->json(
                $ex->validator->errors()
                , Response::HTTP_BAD_REQUEST
            );
        });

        $this->renderable(function (NotFoundHttpException $ex, $request) {
            $prev = $ex->getPrevious();
            if ($prev && $prev instanceof ModelNotFoundException)
                return response()->json(
                    [
                        'message' => sprintf(
                            '%s %s %s'
                            , 'Sorry, your requested'
                            , Str::plural('resource', count($prev->getIds()))
                            , 'not found.'
                        ),
                        'resources' => $prev->getIds(),
                    ],
                    Response::HTTP_NOT_FOUND
                );
            else
                return response()->json(
                    $ex->getMessage()
                    , Response::HTTP_NOT_FOUND
                );
        });

    }
}
