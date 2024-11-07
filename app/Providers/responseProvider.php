<?php

namespace App\Providers;

use http\Message;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class responseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data = []) {
            return Response::json($data, 200);
        });

        Response::macro('badRequest', function ($data = []) {
            return Response::json(['error' => $data], 400);
        });
        Response::macro('unauthorized', function ($data = []) {
            return Response::json(['error' => $data], 401);
        });
        Response::macro('paymentRequired', function ($data = []) {
            return Response::json(['error' => $data], 402);
        });
        Response::macro('forbidden', function ($data = []) {
            return Response::json(['error' => $data], 403);
        });
        Response::macro('notFound', function ($data = []) {
            return Response::json(['error' => $data], 404);
        });
        Response::macro('unprocessable', function ($message ,$errors = []) {
            if ($errors instanceof MessageBag) {
                $err = [];
                foreach ($errors as $error) {
                    $err[] = $error->toArray();
                }
                $errors = $err;
            }
            return Response::json(['message' => $message, 'error' => $errors], 422);
        });
        Response::macro('tooManyRequests', function ($data = []) {
            return Response::json(['error' => $data], 429);
        });
    }
}
