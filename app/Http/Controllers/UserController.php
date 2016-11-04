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
    public function getLogin( Request $request ){



        $access_token = \Session::get('token');
        $refresh_token = \Session::get('refresh');
        


        if(!is_null($access_token) && !is_null($refresh_token)){

            $client = new GuzzleHttp\Client();

            $token_path = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$access_token.'';

            $response = $client->request('GET',$token_path,['http_errors' => false]);

            $statusCode = $response->getStatusCode();

            if($statusCode == 200){

                $user = GuzzleHttp\json_decode($response->getBody(),true);

                $currentUser = $this->updateUserData( $user , $access_token , $refresh_token );

                if(!is_null($currentUser)){

                    $output = array();
                    $output['token'] = $currentUser->remember_token;
                    $output['user']['id'] = $currentUser->id;
                    $output['user']['name'] = $currentUser->name;
                    $output['user']['email'] = $currentUser->email;
                    $output['user']['avatar'] = $currentUser->avatar;

                    return response()->json($output);

                } else {

                    return response('Missing In DB' ,201 )->setStatusCode(403);

                }
                
            } else {

                return response('Invalid Token', 401);
            }
            
        } else {

            return response('Null token or refresh token',401);
        }


        
    }

    /**
     * @SWG\Post(
     *   path="/api/v1/auth",
     *     tags={"Auth"},
     *   summary="Authorization",
     *     description="{Auth}",
     *   @SWG\Response(
     *     response=200,
     *     description="Auth"
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

    public function getUsers( ){

        $users  = User::all();

        return response()->json($users);

    }

    /**
     * @SWG\Get(
     *   path="/api/v1/users",
     *   tags={"Users"},
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

    public function getTest(){
        

        return response('You are here, Its "200" for you',200);
    }

}
