<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticate
{
    private UserRepositoryInterface $user;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->input('key');

        if (empty($key)) {
            return response()->json(['message' => 'key is required'], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->user->checkKey($key);

        if (empty($user)) {
            return response()->json(['message' => 'invalid key, authenticate properly'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
