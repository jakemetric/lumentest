<?php namespace App\Http\Middleware;

use Closure;
use Cache;
use Jenssegers\Agent\Agent;

class BotMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = [
            'status' => 'ERROR',
            'message' => '',
            'data' => []
        ];

        $ua_hashed = md5('ua_'.$request->server('HTTP_USER_AGENT'));

        if(!Cache::has($ua_hashed)) {
            $agent = new Agent;
            $is_bot = $agent->isRobot();
            Cache::forever($ua_hashed, $is_bot);
        }
        else
            $is_bot = Cache::get($ua_hashed);

        if($is_bot) {
            $response['message'] = 'Bot request is not allowed.';
            return response()->json($response, 403);
        }

        return $next($request);
    }

}
