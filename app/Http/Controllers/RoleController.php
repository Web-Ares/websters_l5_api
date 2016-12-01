<?php

namespace App\Http\Controllers;
use App\Role;

class RoleController extends Controller
{
    public function getRoles(){

        $roles = Role::all();
        
        return response()->json($roles);
        
    }

    /**
     * @SWG\Get(
     *   path="/api/v1/roles",
     *     tags={"Roles"},
     *   summary="Get all roles",
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
    
    public function deleteRoles($id){

        $role = Role::where('id',$id)->first();
        if(!is_null($role)){
            $role->delete();

            return response('Role was deleted',204);

        } else {
            return response('Missing in DB',404);
        }

    }

}

