<?php

namespace App\Http\Middleware;

final class LowerCaseUrls
{
    public function handle($request, \Closure $next){
        $path=$request->path();

        if ($path!==strtolower($path)) {
            //går till lower case
            return redirect(strtolower($request->getRequestUri()));
        }
        return $next($request);
    }
}
