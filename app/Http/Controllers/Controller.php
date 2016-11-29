<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Illuminate\Support\Facades\DB;
use Google_Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateUserData( $userData, $token , $refresh , $expires ){

        $email = $userData['email'];

        $user = User::where( 'email', $email )->first();
     
        if(!is_null($user)){

            $count = 0;
            
            if($user->avatar != $userData['picture']){
                $user->avatar = $userData['picture'];
                $count++;
            }

           if($user->google_token != $token){
               $user->google_token = $token;
               $count++;
           }

            if($user->refresh_google_token != $refresh){
                $user->refresh_google_token = $refresh;
                $count++;
            }
         
            if($user->expires != $expires){
                $user->expires = $expires;
                $count++;
            }

            if($count!=0){
                $user->save();
            }
            

            return $user;

        }
        
        else {
            
            return null;
            
        }
        
    }
    
    public function refreshToken( $remember_token ) {

        $user = User::where( 'remember_token', $remember_token )->first();
        $access_token = $user->access_token;
        $refresh_token = $user->refresh_token;
        if(!is_null($user)){

                $client = new Google_Client();
                $client->setAccessToken($access_token);

                if ($client->isAccessTokenExpired()) {
                    $client->refreshToken($refresh_token);
                    $access_token = $client->getAccessToken();
                    $tokens_decoded = json_decode($access_token);
                    $refreshToken = $tokens_decoded->refresh_token;
                    $user->google_token = $refreshToken;
                    $user->access_token = $access_token;
                    $user->save();
                } else {

                    return response('Missing in DB',401);

                }

        }

    }

    public function userFormat($user){

        $positions_ids = DB::table('user_position')->select('position_id')->where('user_id', '=', $user->id)->get();
    
        $technology_ids = DB::table('user_technology')->select('technology_id')->where('user_id', '=', $user->id)->get();

        $user['position_ids'] = $positions_ids;

        $user['technology_ids'] = $technology_ids;

        return $user;
    }
    
}



