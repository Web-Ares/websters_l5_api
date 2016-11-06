<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use GuzzleHttp;
use Google_Client;
use Illuminate\Session;
class CheckGoogleToken
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
//        $code = $_GET['code'];
        if($code){

            $user = User::where('remember_token',$code)->first();

            if(!is_null($user)){

                    $access_token = $user->google_token;
                    $refresh_token = $user->refresh_google_token;

                    $client = new Google_Client();
                    $client->setAuthConfig('client_secret.json');
                    $client->setAccessToken($access_token);

                    if ( time()-$user->expires > 3599 ) {

                        $client->refreshToken($refresh_token);

                        $access_token = $client->getAccessToken();

                        $tokens_decoded = $access_token;
                        $access_token = $tokens_decoded['access_token'];

                        $user->google_token = $access_token;
                     
                        $user->save();

                    }
           
                return $next($request);
            }
            else {
                return response('Code invalid',401);
            }

        }
        else {

            return response('Code Missing',401);

        }

    }

}
