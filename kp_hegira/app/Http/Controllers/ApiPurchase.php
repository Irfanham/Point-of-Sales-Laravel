<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\PurchaseTransaction;
use App\Supplier;
use App\Warehouse;
use Illuminate\Support\Facades\Input;

class ApiPurchase extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $purchases=PurchaseTransaction::all();
        $supplier=Supplier::all();
        $warehouse=Warehouse::all();
        return response()->json([
            'data'=>$purchases,'dataSupplier'=>$supplier,'dataWarehouse'=>$warehouse
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
        $purchases=new SaleTransaction;
        $purchases->qty=$request->input('quantity');
        $purchases->price=$request->input('unitPrice');
        $purchases->totalPrice=$request->input('totalPrice');
        $purchases->date_time=$request->input('date_time');
        $success=$purchases->save();
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
        $purchases=PurchaseTransaction::find($id);
        if(is_null($purchases)){
            return response()->json('not found',404);
        } return response()->json($purchases,200);
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
        $purchases=PurchaseTransaction::find($id);
        !is_null($request->input('quantity'))?$purchases->quantity=$request->input('quantity'):$purchases->quantity;
        !is_null($request->input('unitPrice'))?$purchases->unitPrice=$request->input('unitPrice'):$purchases->unitPrice;
        !is_null($request->input('totalPrice'))?$purchases->totalPrice=$request->input('totalPrice'):$purchases->totalPrice;
        !is_null($request->input('date_time'))?$purchases->date_time=$request->input('date_time'):$purchases->date_time;
        $success=$purchases->update();
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
        $purchases=PurchaseTransaction::find($id);
        if(is_null($purchases)){
            return response()->json('not found',404);
        }
        $success=$purchases->delete();
        if(!$success){
            return response()->json('error',500);
        }   return response()->json('success',200);  


    }
}
