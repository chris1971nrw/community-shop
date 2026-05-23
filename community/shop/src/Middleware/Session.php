<?php
/**
 * Session-Middleware
 */

namespace CommunityShop\Middleware;

use CommunityShop\Session;

class Session
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function __invoke($next)
    {
        $this->session->start();
        
        $response = $next($request);
        
        return $response->withHeader('Set-Cookie', session_get_cookie_params());
    }
}
