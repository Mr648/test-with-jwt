<?php

namespace App\Http\Middleware;

use App\Models\Enums\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!in_array($role, [Roles::ADMIN, Roles::AUTHOR])) {
            throw new NotFoundHttpException(sprintf('The specified role [%s] is not supported.', $role));
        }

        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }
        abort(401);
    }
}
