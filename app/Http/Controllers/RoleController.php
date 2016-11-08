<?php

namespace App\Http\Controllers;
use App\Role;

class RoleController extends Controller
{
    public function getRoles(){

        $roles = Role::all();

        if(count($roles)!==0):
            return response()->json($roles);
        else:
            return response('Roles not exist yet',404);
        endif;

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
}

