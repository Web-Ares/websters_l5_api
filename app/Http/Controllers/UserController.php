<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Swagger\Annotations as SWG;
use Laravel\Socialite\Facades\Socialite;


/**
 * @SWG\Info(title="Websters API", version="0.0.1")
 */


class UserController extends Controller
{



    public function getUsers( ){

        $users  = User::all();

        return response()->json($users);

    }

    /**
     * @SWG\Get(
     *   path="/api/v1/users",
     *   summary="get users",
     *     description="Get Users request",
     *   @SWG\Response(
     *     response=200,
     *     description="Get all users"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * @SWG\Parameter(
         type="string",
         name="Authorization",
         in="header",
         required=true)
     * )
     */

    public function getTestValue(){
        
        return 222;
    }

    public function getGoogle(){

        return view('welcome');
    }


    public function getSocialAuth(){

        return Socialite::driver('google')->redirect();
    }

    public function getCallback( Request $request )
    {
        
        $user = Socialite::driver('google')->user();

        dd($user);
        
    }

    
    public function getLogin(){

        

    }

    
}
