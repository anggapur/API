<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use JP;
use DB;
use App\product;
class categoryCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = category::with(array('child' => function($query){
                    $query->with('child')->select('*');
                }))
                ->where('parent_id','0')->get();
        
        if($query)
        {
            $data['message'] = 'success';
            $data['results'] = $query;
        }
        else
        {
            $data['message'] = 'failed';
        }

        return JP::prints($data);
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
    public function show($id,Request $request)
    {
        $data_per_page = $request->input('data_per_page');
        if(!$data_per_page)
            $data_per_page = 10;
        //query get id's
         $query = category::with(array('child' => function($query){
                    $query->with('child')->select('*');
                }))
                ->where('id',$id)->get();
        $ids= array();
        foreach($query as $val)
        {
            //floor 1            
            array_push($ids,$val->id);
            if($val->child !== "")
            {
                foreach ($val->child as $value) {
                    // floor 2                
                    array_push($ids,$value->id);
                    if($value->child !== "")
                    {
                        foreach ($value->child as $values) {                            
                            array_push($ids,$values->id);
                        }
                    }
                }
            }
        }
        //show product by ids
        $query = product::whereIn('category_id',$ids)->paginate($data_per_page);
        if($query)
        {
            $data['message'] = 'success';
            $data['results'] = $query;
        }
        else
        {
            $data['message'] ='failed';
        }
        return JP::prints($data);


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
}
