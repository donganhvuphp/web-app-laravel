<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException)
        {
            return response()->json([
                'status' => HTTP_STATUS['PAGE_EXPIRED'],
                'message' => $e->getMessage()
            ], HTTP_STATUS['NOT_FOUND']);
        }

        if ($e instanceof NotFoundHttpException)
        {
            return response()->json([
                'status' => HTTP_STATUS['NOT_FOUND'],
                'message' => 'page notfound'
            ], HTTP_STATUS['NOT_FOUND']);
        }

        if ($e instanceof QueryException)
        {
            return response()->json([
                'status' => HTTP_STATUS['NOT_FOUND'],
                'erro' => 'Query notfound',
                'message' => $e->getMessage()
            ], HTTP_STATUS['NOT_FOUND']);
        }

        if ($e instanceof MethodNotAllowedHttpException)
        {
            return response()->json([
                'status' => HTTP_STATUS['PAGE_EXPIRED'],
                'erro' => 'Check the request',
            ], HTTP_STATUS['NOT_FOUND']);
        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }




}
