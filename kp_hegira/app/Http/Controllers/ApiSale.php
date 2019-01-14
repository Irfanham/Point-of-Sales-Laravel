<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\SaleDetail;
use App\SaleTransaction;
use App\Warehouse;

use Illuminate\Support\Facades\Input;

class ApiSale extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $details=SaleDetail::all();
        $sale=SaleTransaction::all();
        $warehouse=Warehouse::all();
        return response()->json([
            'data'=>$sale,
            'dataWarehouse'=>$warehouse,
            'dataDetail'=>$details
        ],200);
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
        $details=new SaleTransaction;
        $details->qty=$request->input('quantity');
        $details->totalPrice=$request->input('totalPrice');
        $details->discount=$request->input('discount');
        $success=$details->save();
        if(!$success){
            return response()->json('error saving',500);
        }return response()->json('success',200);
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
        $details=SaleTransaction::find($id);
        if(is_null($details)){
            return response()->json('not found',404);
        } return response()->json($details,200);
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
        $details=SaleTransaction::find($id);
        !is_null($request->input('quantity'))?$details->quantity=$request->input('quantity'):$details->quantity;
        !is_null($request->input('totalPrice'))?$details->totalPrice=$request->input('totalPrice'):$details->totalPrice;
        !is_null($request->input('discount'))?$details->discount=$request->input('discount'):$details->discount;
        $success=$details->update();
        if(!$success){
            return response()->json('error updating',500);
        } return response()->json('success',200);
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
        $details=SaleTransaction::find($id);
        if(is_null($details)){
            return response()->json('not found',404);
        }
        $success=$details->delete();
        if(!$success){
            return response()->json('error',500);
        }   return response()->json('success',200);  


    }
}
