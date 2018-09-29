<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('ENFORCE_HTTPS') === 'true') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}
