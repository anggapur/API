<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\User;
use JP;
use DB;
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
            $query = cart::leftJoin('products','carts.product_id','=','products.id')
                    ->leftJoin('Users','products.seller_id','=','Users.id')
                    ->select('carts.*','products.*','Users.*','Users.name as user_name',DB::raw('carts.qty * products.price_sell as totalHarga'))
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
