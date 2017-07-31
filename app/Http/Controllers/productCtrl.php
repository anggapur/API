<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\category;
use JP;
class productCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get data per page will show
        $dataPerPage = $request->input('data_per_page');
        if(!$dataPerPage)
            $dataPerPage = 10;
        //get order
        $order = $request->input('order');
        if(!$order)
            $order = "ASC";
        //sort by
        $sort = $request->input('sort');
        if(!$sort)
            $sort = "products.id";
        //querying
        $query = product::with([
                    'seller'=>function($q){
                            $q->select('id','name','company_name','send_from');
                        }
                ])                
                ->orderBy($sort,$order)
                ->paginate($dataPerPage);
        
        if($query)
        {
            $data['message'] = "success";
            $data['results'] = $query;    
        }
        else
        {
            $data['message'] = "failed";
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
    public function show($id)
    {
        //
         // ->with(array('category' => function($q){
         //            $q->with(array('parentCategory' => function($q){
         //                $q->with('parentCategory')->select('*');        
         //            }))->select('*');        
         //        }))
        
        $query = product::with(array('seller' => function($q){
                    $q->select('id','name','avatar','company_name');        
                }))
                ->with('category')
                ->withCount('seen')
                ->with('rate')
                ->with('image')
                ->findorFail($id);

        //category
        $q = category::with(array('child' => function($query){
                    $query->with('child')->select('*');
                }))
                ->where('id',$query->category_id)->get();
        $ids= array();
        foreach($q as $val)
        {
            //floor 1            
            array_push($ids,$val->name);
            if($val->child !== "")
            {
                foreach ($val->child as $value) {
                    // floor 2                
                    array_push($ids,$value->name);
                    if($value->child !== "")
                    {
                        foreach ($value->child as $values) {                            
                            array_push($ids,$values->name);
                        }
                    }
                }
            }
        }
        //print_r($ids);

        if($query)
        {
            
            $data = $query;
            $data['message'] = 'success';
            $data['tags'] = $ids;
        }
        else
        {
            $data['message'] = 'failed';
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
        return $id;
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
    public function search($qs,Request $request)
    {
        
        //get data per page will show
        $dataPerPage = $request->input('data_per_page');
        if(!$dataPerPage)
            $dataPerPage = 10;
        //get order
        $order = $request->input('order');
        if(!$order)
            $order = "ASC";
        //sort by
        $sort = $request->input('sort');
        if(!$sort)
            $sort = "products.id";
        //querying
        $query = product::with([
                    'seller'=>function($q){
                            $q->select('id','name','company_name','send_from');
                        }
                ])                
                ->orderBy($sort,$order)
                ->where('products.name','like','%'.$qs.'%')
                ->paginate($dataPerPage);
        
        if($query)
        {
            $data['message'] = "success";
            $data['results'] = $query;    
        }
        else
        {
            $data['message'] = "failed";
        }

        return JP::prints($data);
    }
}
