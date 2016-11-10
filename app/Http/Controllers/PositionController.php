<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
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

        $position = Position::where('id',$id)->first();
        if(!is_null($position)){


        $name_ru  = $request->name_ru;
        $name_ua  = $request->name_ua;
        $name_en  = $request->name_en;
        if(
        !empty($name_ru)&&!empty($name_ua)&&!empty($name_en)
        )
        {
            $position->name_ua = $name_ua;
            $position->name_ru = $name_ru;
            $position->name_en = $name_en;
            $position->save();

            return response()->json($position);

        } else {
            return response('The posithion has the same structure',404);
        }
        } else {
            return response('Missing in DB',404);
        }

    }

    /**
     * @SWG\Put(
     *   path="/api/v1/positions/{id}",
     *     tags={"Positions"},
     *   summary="Update a positions",
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
     *      *@SWG\Parameter(
    type="string",
    name="name_ua",
    in="query",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="name_ru",
    in="query",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="name_en",
    in="query",
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $position = Position::where('id',$id)->first();
        if(!is_null($position)){
            $position->delete();

            return response('Position was deleted');

        } else {
            return response('Missing in DB',404);
        }
        
    }

    /**
     * @SWG\Delete(
     *   path="/api/v1/positions/{id}",
     *     tags={"Positions"},
     *   summary="Delete a positions",
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
     * @return \Illuminate\Http\Response
     */

    public function index(){

        $positions = Position::all();
        $message = 'Positions not exist yet';

        if(count($positions)){
            return response()->json($positions);
        }
        else{
            return response($message,404);
        }
        

    }

    /**
     * @SWG\Get(
     *   path="/api/v1/positions",
     *     tags={"Positions"},
     *   summary="Create a positions",
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

    public function store(Request  $request){

        $name_ru  = $request->name_ru;
        $name_ua  = $request->name_ua;
        $name_en  = $request->name_en;

        if(!empty($name_ru) && !empty($name_ua) && !empty($name_en)){

            $position = new Position();
            $position->name_ua = $name_ua;
            $position->name_ru = $name_ru;
            $position->name_en = $name_en;
            $position->save();

            return response()->json($position);

        } else {

            return response('Fill all names of position',404);
        }


    }

    /**
     * @SWG\Post(
     *   path="/api/v1/positions",
     *     tags={"Positions"},
     *   summary="Create a position",
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
    name="name_ua",
    in="query",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="name_ru",
    in="query",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="name_en",
    in="query",
    required=true),
     *
     *
     * )
     */
}
