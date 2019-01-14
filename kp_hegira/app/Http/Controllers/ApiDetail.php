<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\SaleDetail;
use App\Customer;
use App\Employee;

use Illuminate\Support\Facades\Input;

class ApiDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $detail=SaleDetail::all();
        $customer=Customer::all();
        $employee=Employee::all();
        return response()->json([
            'data'=>$detail,
            'dataEmployee'=>$employee,
            'dataCustomer'=>$customer,
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
        $sales=new SaleDetail;
        $sales->purchase=$request->input('purchase');
        $success=$sales->save();
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
        $sales=SaleDetail::find($id);
        if(is_null($sales)){
            return response()->json('not found',404);
        } return response()->json($sales,200);
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
        $sales=SaleDetail::find($id);
        !is_null($request->input('purchase'))?$sales->purchase=$request->input('purchase'):$sales->purchase;
        $success=$sales->update();
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
        $sales=SaleDetail::find($id);
        if(is_null($sales)){
            return response()->json('not found',404);
        }
        $success=$sales->delete();
        if(!$success){
            return response()->json('error',500);
        }   return response()->json('success',200);  


    }
}
