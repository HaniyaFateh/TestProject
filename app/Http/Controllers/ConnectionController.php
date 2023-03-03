<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as UserRequest; 
use App\Models\Connection;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get All Connections
        $data = Connection::select('connections.*','users.id as user_id','users.name','users.email')
            ->where('user_id','=',auth()->user()->id)
            ->join('users','users.id','=','connections.connection_id')
            ->get();
        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //connection in common
        $connection = Connection::where('id','=',$id)->first();
        $otherCon   = $connection->connection_id;

        $getCon     = Connection::select('connections.id','users.name','users.email')
                    ->where('user_id','=',$otherCon)
                    ->join('users','users.id','=','connections.connection_id')->get();

        return response()->json(['data'=>$getCon],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
        //remove connections
        $response = Connection::where('id','=',$id)->first();
        $detele   = $response->delete();

        //remove Request
        $requestResponse = UserRequest::where('sender_id','=',$response->connection_id)
        ->where('receiver_id','=',$response->user_id)
        ->first();
        $requestResponse->delete();

        return response()->json(['data'=>'Data Removed Successfully'],200);
        
    }
}
