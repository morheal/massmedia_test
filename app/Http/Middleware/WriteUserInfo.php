<?php

namespace App\Http\Middleware;

use Closure;
use App\Session;
use Cache;
use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;

class WriteUserInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Session::where('user_id', session()->getId())->first() == null ) {
          $user_ip = $_SERVER['REMOTE_ADDR'];
          $provider = new WhichBrowser();
          $user_browser = '';
          try {
              /* @var $result \UserAgentParser\Model\UserAgent */
              $result = $provider->parse('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36');
              $user_browser = $result->getBrowser()->getName();
          } catch (NoResultFoundException $ex){
              $user_browser = 'Other';
          }
          Session::insert(['user_id' => session()->getId(), 'browser' => $user_browser, 'ip' => $user_ip]);
        }
        return $next($request);
    }
}
