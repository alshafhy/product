<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class TrustRequestHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!in_array($request->getHost(),$this->allowedHosts())) {
            abort(400, 'Invalid request.');
        }

        $referrer = $request->headers->get('referer');
        if (is_string($referrer) &&  $this->validateDomain($referrer) === false) {
            $request->headers->remove('referer');
            App::abort(400, 'Invalid Referer header');
        }
        
        return $next($request);
    }

    protected function validateDomain(string $referrer): bool
    {
        $referrerDomain = parse_url($referrer, PHP_URL_HOST);
        
        if($referrerDomain != parse_url(env('APP_URL'), PHP_URL_HOST)){
            return false;
        }
        return true;
    }

    public function allowedHosts(): array
    {
        return [
            'localhost', 
            '127.0.0.1',
            parse_url(env('APP_URL'), PHP_URL_HOST)
        ];
    }
}
