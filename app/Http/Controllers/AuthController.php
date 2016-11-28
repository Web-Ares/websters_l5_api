<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

/**
 * @SWG\Info(title="Websters API", version="0.0.1")
 */
class AuthController extends Controller
{
    public function getLogin( Request $request ){
        
        $access_token = \Session::get('token');
        $refresh_token = \Session::get('refresh');
        $expires = \Session::get('expires');
        if(!is_null($access_token) && !is_null($refresh_token)){

            $client = new GuzzleHttp\Client();

            $token_path = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$access_token.'';

            $response = $client->request('GET',$token_path,['http_errors' => false]);

            $statusCode = $response->getStatusCode();

            if($statusCode == 200){

                $user = GuzzleHttp\json_decode($response->getBody(),true);
          
                $currentUser = $this->updateUserData( $user , $access_token , $refresh_token ,$expires );

                if(!is_null($currentUser)){
                    
                    $user_current = $this->userFormat($currentUser);

                    return response()->json($user_current);

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
}
