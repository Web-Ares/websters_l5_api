<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp;
use Google_Client;
use Illuminate\Session;
class AuthGoogle

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

        $code = \Request::header('Authorization');

        if($code){


        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->authenticate($code);
        $access_array_token = $client->getAccessToken();

            $token = $access_array_token['access_token'];
            $refresh = $access_array_token['refresh_token'];

          
            if(!is_null($token) && !is_null($refresh)){
                

                \Session::flash('token', $token);
                \Session::flash('refresh', $refresh);
                
                return $next($request);

            } else {

                return response('Invalid code',401);

            }

        } else {
            return response('Code Missing',401);
        }
        
    }
}
