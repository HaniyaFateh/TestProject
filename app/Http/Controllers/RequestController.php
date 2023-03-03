<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as UserRequest; 
use App\Models\Connection;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //send request get
        $data   = UserRequest::select('requests.*','users.id as user_id','users.name','users.email')
                   ->where('sender_id','=',auth()->user()->id)
                   ->where('status','=','0')
                   ->join('users','users.id','=','requests.receiver_id')
                   ->get();
        return response()->json($data,200);
    }

    public function receiveRequest()
    {
        $data = UserRequest::select('requests.*','users.id as user_id','users.name','users.email')
            ->where('receiver_id','=',auth()->user()->id)
            ->where('status','=','0')
            ->join('users','users.id','=','requests.sender_id')
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
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //AcceptReceivedRequest
        $response = UserRequest::where('id','=',$id)->first();
        $update   = $response->update([
                        'status' => '1'
                    ]);

        if($update)
        {
            Connection::insert([
                'connection_id' => $response->sender_id,'user_id' => $response->receiver_id
            ]);
            return response()->json('Data Updated Successfully',200);
        }
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
        //withdrawSendRequest
        $response = UserRequest::where('id','=',$id)->first();
        $delete   = $response->delete();
        return response()->json('Data Deleted Successfully',200);
    }
}
