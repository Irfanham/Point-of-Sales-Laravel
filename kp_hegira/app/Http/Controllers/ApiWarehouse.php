<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Warehouse;
use App\Category;
use Illuminate\Support\Facades\Input;
class ApiWarehouse extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouses=Warehouse::all();
        $category=Category::all();
        return response()->json([
            'data'=>$warehouses,
            'dataCategory'=>$category
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
        $warehouses=new Warehouse;
        $warehouses->name=$request->input('name');
        $warehouses->img=$request->input('img');
        $warehouses->stock=$request->input('stock');
        $warehouses->price=$request->input('unitPrice');
        $warehouses->date_update=$request->input('date_update');
        $succcess=$warehouses->save();

        if(!$succcess){
            return response()->json('error saving',500);
        }else{
            return response()->json('succcess',200);
        }

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
        $warehouses=Warehouse::find($id);
        if(is_null($warehouses)){
            return response()->json("not found",404);
        }else{
            return response()->json($warehouses,200);
        }
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
        $warehouses=Warehouse::find($id);

        !is_null($request->input('name'))?$warehouses->name=$request->input('name'):$warehouses->name;
        !is_null($request->input('img'))?$warehouses->img=$request->input('img'):$warehouses->img;
        !is_null($request->input('stock'))?$warehouses->qty=$request->input('stock'):$warehouses->qty;
        !is_null($request->input('unitPrice'))?$warehouses->unitPrice=$request->input('unitPrice'):$warehouses->unitPrice;
        !is_null($request->input('date_update'))?$warehouses->date_update=$request->input('date_update'):$warehouses->date_update;
        $succcess=$warehouses->update();
        if(!$succcess){
            return response()->json("error updating",500);
        } return response()->json("success",200);
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
        $warehouses=Warehouse::find($id);

        if(is_null($warehouses)){
            return response()->json("not found",404);
        }else{
            $succcess=$warehouses->delete();
            if(!$succcess){
             return response()->json("error deleting",500);
            }return response()->json("succcess",200);
        }
    }
}
