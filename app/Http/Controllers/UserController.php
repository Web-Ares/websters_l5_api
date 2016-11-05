<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Swagger\Annotations as SWG;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp;
use Illuminate\Session;
/**
 * @SWG\Info(title="Websters API", version="0.0.1")
 */


class UserController extends Controller
{
    
    public function getUsers( ){

        $users  = User::all();

        return response()->json($users);

    }
    
}
