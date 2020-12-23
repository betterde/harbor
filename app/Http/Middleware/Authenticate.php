<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param Request $request
     * @param  array  $guards
     * @return JsonResponse
     */
    protected function unauthenticated($request, array $guards): JsonResponse
    {
        return failed('Unauthorized', 401);
    }
}
