<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\User;
use JP;
class cartCtrl extends Controller
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
        //cek apakah ada beli
        $cek = cart::where([
                'product_id' => $request->input('product_id'),
                'buyer_id' => $request->input('buyer_id'),
            ])->get();        
        if(count($cek) == 0)
        {
            $datas['product_id'] = $request->input('product_id');
            $datas['qty'] = $request->input('qty');
            $datas['buyer_id'] = $request->input('buyer_id');
            $query = cart::create($datas);
            if($query)
                $data['message'] = "success";
            else
                $data['message'] = "failed";
        }
        else
        {
            $data['message'] = "failed";
        }

        return JP::prints($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //cek user
        $cek = User::find($id);
        if($cek)
        {
            $query = cart::with(array('products'=>function($q){
                $q->with(array('seller' => function($qu){
                    $qu->select('id','name','send_from','avatar','company_name');
                }));
            }))
                    ->where('buyer_id',$id)->get();
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
