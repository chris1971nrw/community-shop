<?php
/**
 * Logging-Middleware
 */

namespace CommunityShop\Middleware;

class Logging
{
    public function __invoke($next)
    {
        $start = microtime(true);
        
        $request = $next($request);
        
        $duration = round((microtime(true) - $start) * 1000);
        
        $log = sprintf(
            '[%s] %s %s %s - %s ms\n',
            date('Y-m-d H:i:s'),
            $request->getMethod(),
            $request->getUri(),
            $request->getStatusCode(),
            $duration
        );
        
        file_put_contents('/var/log/community-shop/access.log', $log, FILE_APPEND);
        
        return $request;
    }
}
