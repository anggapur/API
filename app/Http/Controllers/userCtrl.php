<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
class userCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(),[
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'name' => 'required',
                'username' => 'required|unique:users',
                'phone'=>'required',
            ]);
        if($validator->fails())
        {
            $data['message'] = "failed";
            $data['results'] = $validator->errors();
        }
        else
        {
            $data['message'] = "success";
        }

        return $data;
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
        //
    }

    public function login(Request $request)
    {
         if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')]))
        {
            $data['message'] = 'success';
            $data['user'] = Auth::user();
        }
        else if(Auth::attempt(['username' => $request->input('email'),'password' => $request->input('password')]))
        {
            $data['message'] = 'success';
            $data['results'] = Auth::user();
        }
        else
        {
             $data['message'] = 'failed';
        }

        return $data;
    }
}
