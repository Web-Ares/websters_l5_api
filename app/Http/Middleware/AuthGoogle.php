<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Request as defRequest;
use Google_Client;
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
//        $code = $_GET['code'];
        $code = \Request::header('Authorization');

        if($code){


        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->authenticate($code);
        $access_array_token = $client->getAccessToken();
        
            if(!is_null($access_array_token) || (!is_null($access_array_token['access_token']) && !is_null($access_array_token['refresh_token']))){

                $request->merge(array(
                    'access_token' => $access_array_token['access_token'],
                    'refresh_token' => $access_array_token['refresh_token']
                ));

                return $next($request);

            } else {

                return response('Invalid code',401);

            }

        } else {
            return response('Code Missing',401);
        }
        
    }
}
