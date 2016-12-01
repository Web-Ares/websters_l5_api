<?php

namespace App\Http\Controllers;

use App\Position;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use GuzzleHttp;
use Validator;
use App\Technology;

class UserController extends Controller
{

    public function show($id = null){

        if($id == 'me') {
            $code = \Request::header('Authorization');
            $user = User::where('remember_token', $code)->first();
            $currentUser = $this->userFormat($user);
            
        }
        elseif(is_null($id)) {
            $users = User::all();
            foreach ($users as $user){
                $currentUser[] = $this->userFormat($user);
            }
        }
        else {
            $user = User::where('id', $id)->first();
            $currentUser = $this->userFormat($user);
        }
        return response()->json($currentUser);


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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $email = $request->email;
        $name = $request->name;
        $name_ua = $request->name_ua;
        $name_ru = $request->name_ru;


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


                $currentUser = $this->userFormat($user);
                return response()->json($currentUser);

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

            return response('User was deleted',204);

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
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */

    public function getTest($id, Request $request){

        $position_id = 2;
        $technology_id = 1;
        $position = Position::find($position_id);
        $technology = Technology::find($technology_id);

        $position->technologies()->save($technology);

        $tech_post = $technology->position;


        return $tech_post->name_ua;
    }


    public function update($id, Request $request){
        $flag = false;
        $user_id = $id;
        $role_id = $request->role_id;
        $technologies_ids = $request->technologies_ids;
        $positions_ids = $request->positions_ids;

        $name = $request->name;
        $name_ua = $request->name_ua;
        $name_ru = $request->name_ru;


        $role = Role::find($role_id);
        $user = User::find($user_id);

        if($name){
            $flag = true;
            $user->name = $name;
        }

        if($name_ua){
            $flag = true;
            $user->name_ua = $name_ua;
        }

        if($name_ru){
            $flag = true;
            $user->name_ru = $name_ru;
        }



        if($technologies_ids){
            if($technologies_ids!=''){
                $technologies_ids = explode(',' , $technologies_ids);
            } else {
                $technologies_ids = [];
            }
            $user->technologies()->sync($technologies_ids);
        }


        if($positions_ids){
            if($positions_ids!=''){
                $positions_ids = explode(',' , $positions_ids);
            } else {
                $positions_ids = [];
            }
            $user->positions()->sync($positions_ids);
        }

        if($role_id){
            $flag = false;
            $role->users()->save($user);
        }

        if($flag){
            $user->save();
        }
        
        $userCurrent = $this->userFormat($user);
        return response()->json($userCurrent);
    }
    
}
