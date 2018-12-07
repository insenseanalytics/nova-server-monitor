<?php

namespace Insenseanalytics\NovaServerMonitor\Http\Middleware;

use Insenseanalytics\NovaServerMonitor\NovaServerMonitor;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(NovaServerMonitor::class)->authorize($request) ? $next($request) : abort(403);
    }
}
