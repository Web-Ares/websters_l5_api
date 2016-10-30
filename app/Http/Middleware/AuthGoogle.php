<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Request as defRequest;

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

        
        $headerAuthorization = defRequest::header('Authorization');
        $headerAuthorization = $_GET['token'];
        //If token isset
        if($headerAuthorization){

            $client = new GuzzleHttp\Client();

            $token_path = 'https://www.googleapis.com/plus/v1/people/me?access_token='.$headerAuthorization;

            $response = $client->request('GET',$token_path,['http_errors' => false]);

            $statusCode = $response->getStatusCode();

            $user = GuzzleHttp\json_decode($response->getBody(),true);

            dd($user);

        }
        else {

            return response('Token Missing', 403);
            
        }
      

        
    }
}
