<?php
namespace App\Http\Middleware;

use Closure;

class AirLoading
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if($response->status()==302 && $request->headers->get('x-airload')){
        	$response->setStatusCode(320);
        }
        return $response;
    }
}