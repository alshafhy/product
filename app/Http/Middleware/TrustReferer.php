<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class TrustReferer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $referrer = $request->headers->get('referer');
    
        if (is_string($referrer) &&  $this->validateDomain($referrer) === false) {
            $request->headers->remove('referer');
            App::abort(403, 'Bad URL');
        }
        
        return $next($request);
    }

    protected function validateDomain(string $referrer): bool
    {
        $referrerDomain = parse_url($referrer, PHP_URL_HOST);
        // dd($referrerDomain );
        $referrerScheme = parse_url($referrer, PHP_URL_SCHEME);
        $referrerDomain = str_replace('www.','',$referrerDomain);
        $r = $referrerScheme . '://'.$referrerDomain;
        if($r != env('APP_URL')){
            return false;
        }
        return true;
    }
}
