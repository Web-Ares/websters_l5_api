<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Response;

class UsersCustom extends Controller
{
    public function get2( $a ){
        
        $users  = User::all();
        
        return ['1' => $a.'25'];

    }

    /**
     * @SWG\Get(
     *   path="/api/v1/users/2",
     *   summary="get FFF",
     *   @SWG\Response(
     *     response=200,
     *     description="Get FFF"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */

}
