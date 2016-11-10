<?php

namespace App\Http\Controllers;

use App\Position;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use GuzzleHttp;
use Validator;
class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::where('id',$id)->first();
        if(!is_null($user)){
            $user->delete();

            return response('User was deleted');

        } else {
            return response('Missing in DB',404);
        }


    }

    /**
     * @SWG\Delete(
     *   path="/api/v1/users/{id} ",
     *     tags={"Users"},
     *   summary="Delete a user",
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
    required=true),
     *@SWG\Parameter(
    type="string",
    name="id",
    in="path",
    required=true),
     *
     *
     * )
     */
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $email = $request->email;

        if(!is_null($email) && isset($email) && !empty($email)){

            $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:users'
            ]);


            if ($v->fails())
            {

                return response($v->messages()->first() ,404);

                
            } else {

                $user = new User();
                $user->email = $email;
                $user->remember_token = str_random(100);
                $role_user = Role::find(2);
                $role_user->users()->save($user);


                $to      = $email;
                $subject = 'Welcome to Websters Team';
                $message = 'Its a invite to our application, forward here for <a href="">login</a>';
                $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: office@websters' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                return response('User Created', 200);

            }



        }
        else {

            return response('Invalid email', 401);
        }

    }

    /**
     * @SWG\Post(
     *   path="/api/v1/users",
     *     tags={"Users"},
     *   summary="Create a new user",
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
    required=true),
     *@SWG\Parameter(
    type="string",
    name="email",
    in="query",
    required=true),
     *
     *
     * )
     */



    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function getTest($id){
            
            $user = User::find(1)->positions()->get();
            $position = Position::find(8);

            return response()->json($user);
            
        }


    public function show($id){
        $message ='';
        if($id == 'me') {

            $code = \Request::header('Authorization');

            $user = User::where('remember_token', $code)->first();

            if (is_null($user)) {
                $message = 'Invalid me';
            }

        }
        elseif($id == 'all') {

            $user = User::all();

            if (is_null($user)) {
                $message = 'Users not exist yet';
            }

        }
        else {
            $user = User::where('id', $id)->first();

            if (is_null($user)) {
                $message = 'Not found';
            }

        }

        if(!is_null($user)){
            return response()->json($user);
        } else {
            return response($message,404);
        }

    }

    /**
     * @SWG\Get(
     *   path="/api/v1/users/{id}",
     *     tags={"Users"},
     *   summary="Get user",
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
    required=true),
     * @SWG\Parameter(
    type="string",
    name="id",
    in="path",
    required=false)
     * )
     */
    

}
