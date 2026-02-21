<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictIp
{
    /**
     * List of allowed IP addresses.
     * Can be configured in .env file using ALLOWED_IPS variable.
     *
     * @var array
     */
    protected array $allowedIps = [];

    public function __construct()
    {
        // Get allowed IPs from environment variable (comma-separated)
        $allowedIps = env('ALLOWED_IPS', '');
        
        if (!empty($allowedIps)) {
            $this->allowedIps = array_map('trim', explode(',', $allowedIps));
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the client IP address
        $clientIp = $request->ip();

        // If no IPs are configured, allow all (for safety)
        if (empty($this->allowedIps)) {
            return $next($request);
        }
        
        // Check if the client IP is in the allowed list
        if (!in_array($clientIp, $this->allowedIps)) {
            // Option 1: Return 403 Forbidden
            abort(403, 'Access Denied. Your IP address is not authorized.');
            
            // Option 2: Redirect to a custom page (uncomment if needed)
            // return redirect('/unauthorized');
        }
        
        return $next($request);
    }
}
