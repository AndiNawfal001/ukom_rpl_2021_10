<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPageTitleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route() ? $request->route()->getName() : '';
        if (!$routeName) {
            $routeName = trim($request->path(), '/');
        }
        $pageTitle = str_replace('%20', ' ', $routeName);
        view()->share('pageTitle', $pageTitle);
        return $next($request);
    }
}
