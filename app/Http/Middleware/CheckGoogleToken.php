<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp;
use Illuminate\Routing\Route;
use Request;
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

        $headerAuthorization = Request::header('Authorization');

        //If token isset
        if($headerAuthorization){

                $token_path = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token='.$headerAuthorization.'';

                $client = new GuzzleHttp\Client();

                $status_token = $client->request('GET',$token_path,['http_errors' => false]);

                $status_code = $status_token->getStatusCode();

                if( $status_code == 200 ){

                    return $next($request);

            }
            else {

                return response('Invalid token', 401);
            }

        }
        else {

            return response('Token Missing', 403);

        }



    }

}
