<?php
/**
 * CORS-Middleware
 */

namespace CommunityShop\Middleware;

class Cors
{
    public function __invoke($next)
    {
        $response = $next($request);
        
        $response->getBody()->write($response->getBody()->getContents());
        $response = $response->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        
        return $response;
    }
}
