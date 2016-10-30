<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateUserData( $userData, $token ){
      
        $email = $userData['emails'][0]['value'];

        $user = User::where( 'email', $email ) -> first();

        $user->name = $userData['displayName'];


        $user->avatar = $userData['image']['url'];
        $user->token = $token;

        $user->save();
    
        return $user;
    }

  

}



