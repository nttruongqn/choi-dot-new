<?php

namespace App\Http\Middleware;

use App\Repositories\Role\RoleRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckClientLoggedIn
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customer_role_id = $this->roleRepository->getCustomerRoleId();
        if (\Auth::check() && \Auth::user()->id == \Auth::user()->role_id === $customer_role_id) {
            return redirect()->intended('/');
        }
        return $next($request);
    }
}
