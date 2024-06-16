<?php

namespace App\Http\Middleware;

use App\Repositories\Role\RoleRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLoggedIn
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
        $admin_role_id = $this->roleRepository->getAdminRoleId();
        if (\Auth::check() && \Auth::user()->role_id === $admin_role_id) {
            return redirect()->intended('admin/categories');
        }
        return $next($request);
    }
}
