<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Category;
use Illuminate\Support\Facades\Input;

class ApiCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        $warehouse=Warehouse::all();
        return response()->json([
            'data'=>$categories
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
        $categories=new Category;
        $categories->category=$request->input('category');
        $success=$categories->save();
        if(!$success){
            return response()->json("error saving",500);
        }return response()->json("success",200);
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
        $categories=Category::find($id);
        if(is_null($categories)){
            return response()->json("not found",404);
        } return response()->json($categories,200);
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
        $categories=Category::find($id);
        !is_null($request->input('category'))?$categories->category=$request->input('category'):$categories->category;
        $success=$categories->update();
        if(!$success){
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
        $categories=Category::find($id);
        if(is_null($categories)){
            return response()->json("not found",404);
        } 
        $success=$categories->delete();
        if(!$success){
            return response()->json("error deleting",500);
        } return response()->json("success",200);
    }
}
