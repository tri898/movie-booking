<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->descriptiveResponseMethods();
    }

    protected function descriptiveResponseMethods(): void
    {
        $instance = $this;
        Response::macro('ok', function ($data = []) {
            return Response::json(['data' => $data]);
        });

        Response::macro('created', function ($data = []) {
            return Response::json(['data' => $data], 201);
        });

        Response::macro('noContentData', function () {
            return Response::json([], 204);
        });

        Response::macro('validator', function ($errors = [], $message = 'Validate fields fail.') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 422);
        });
        Response::macro('badRequest', function ($errors = [], $message = 'Validation Failure') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 400);
        });

        Response::macro('unauthorized', function ($errors = [], $message = 'User unauthorized') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 401);
        });

        Response::macro('forbidden', function ($errors = [], $message = 'Access denied') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 403);

        });

        Response::macro('notFound', function ($errors = [], $message = 'Resource not found.') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 404);
        });

        Response::macro('internalServerError', function ($errors = [], $message = 'Internal Server Error.') use ($instance) {
            return $instance->handleErrorResponse($errors, $message, 500);
        });
    }

    public function handleErrorResponse($errors, $message, $status): JsonResponse
    {
        $response = [
            'message' => $message,
        ];

        if (count($errors)) {
            $response['errors'] = $errors;
        }

        return Response::json($response, $status);
    }
}
