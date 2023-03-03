<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as UserRequest; 
use App\Models\Connection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receiver_id = UserRequest::where('sender_id','=',auth()->user()->id)->pluck('receiver_id');
        $sender_id   = UserRequest::where('receiver_id','=',auth()->user()->id)->pluck('sender_id');
        $conn_id     = Connection::where('user_id','=',auth()->user()->id)->pluck('connection_id');

        $users       = User::select('id','name','email')
                        ->where('id','<>',auth()->user()->id)
                        ->whereNotIn('id',$receiver_id)
                        ->whereNotIn('id',$sender_id)
                        ->whereNotIn('id',$conn_id)
                        ->get();

        return response()->json($users,200);
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
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //send Request
        UserRequest::insert([
            'sender_id' => auth()->user()->id,'receiver_id'=> $id,'status'=>'0'
        ]);
        return response()->json('send Request successfully',200);
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
        //
    }
}
