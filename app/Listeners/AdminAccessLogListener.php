<?php

namespace App\Listeners;

use App\Events\AdminAccessLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\History;
use Auth;

class AdminAccessLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminAccessLog  $event
     * @return void
     */
    public function handle(AdminAccessLog $event)
    {
        $request = $event->request;
        History::create([
            'user'=>Auth::check()?'guest': $request->user()->id,

            //$_SERVER['REMOTE_ADDR']
            'ip'=>$request->ip(),

            // $request->url() 取的是全部访问地址，path 是 .com 后的值
            'path'=>$request->path(),

            //$_SERVER['QUERY_STRING']
            'query'=>$request->server('QUERY_STRING'),

            //$_SERVER['REQUEST_METHOD']    //$request->server['METHOD']
            'method'=>$request->method(),
            'platform'=>$this->platform($request),
            'browser'=>$this->browser($request),
            'referer'=>$request->header('referer'),
        ]);
    }

    //获取操作系统
    public function platform($request){

        // 两种原生写法 $request->server('HTTP_USER_AGENT'); $request->$_SERVER('HTTP_USER_AGENT');
        $agent = $request->header('User-Agent');

        $platform = 'Unknown';

        if(preg_match('/linux/i',$agent)){
            $platform = 'linix';
        }elseif(preg_match('/macintosh|mac os x/i',$agent)){
            $platform = 'mac';
        }elseif(preg_match('/windows|win32/i',$agent)){
            $platform = 'windows';
        }
        return $platform;
    }

    // 获取浏览器
    public function browser($request){

        $agent = $request->header('User-Agent');

        $browser = 'Unknown';

        if(preg_match('/MSIE/i',$agent) && !preg_match('/Opera/i',$agent))
        {
            $browser = 'Internet Explorer';
        }elseif(preg_match('/Firefox/i',$agent))
        {
            $browser = 'Mozilla Firefox';
        }elseif(preg_match('/Chrome/i',$agent))
        {
            $browser = 'Goole Chrome';
        }elseif(preg_match('/Safari/i',$agent) && !preg_match('/Chrome/i',$agent))
        {
            $browser = 'Apple Safari';
        }elseif(preg_match('/Opera/i',$agent))
        {
            $browser = 'Opera';
        }elseif(preg_match('/Netscape/i',$agent))
        {
            $browser = 'Netscape';
        }

        return $browser;
    }

}
