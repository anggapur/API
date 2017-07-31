<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
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
        $query = product::orderBy($sort,$order)
                ->paginate($dataPerPage);
        
        if($query)
        {
            $data['message'] = "success";
            $data['data'] = $query;
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
