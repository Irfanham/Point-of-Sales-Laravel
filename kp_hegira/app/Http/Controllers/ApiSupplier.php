<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Supplier;
use Illuminate\Support\Facades\Input;

class ApiSupplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //
        $suppliers=Supplier::all();
        return \Response::json([
            'data'=>$suppliers

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
    public function store()
    {
        $suppliers=new Supplier;
        $suppliers->name=Input::get('name');
        $suppliers->email=Input::get('email');
        $suppliers->contact=Input::get('contact');
        $success=$suppliers->save();
    
       if(!$success)
        { 
            return \Response::json("error saving",500);
        }
    
            return \Response::json("success",201);

  } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suppliers=Supplier::find($id);
        if(is_null($suppliers))
        { 
            return \Response::json("error saving",500);
        }
    
            return \Response::json($suppliers,201);

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
    public function update($id)
    {
        $suppliers=Supplier::find($id);
 
        !is_null(Input::get('name')) ? $suppliers->name=Input::get('name') : $suppliers->name;
        !is_null(Input::get('email')) ? $suppliers->email=Input::get('email') : $suppliers->email;
        !is_null(Input::get('contact')) ? $suppliers->contact=Input::get('contact') : $suppliers->contact;
    
        $success=$suppliers->save();
    
        if(!$success)
        {
            return \Response::json("error updating",500);
        }
    
        return \Response::json("success",201);

   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suppliers=Supplier::find($id);
        if(is_null($suppliers))
        {
            return \Response::json("not found",404);
        }
    
        $success=$suppliers->delete();
    
        if(!$success)
        {
            return \Response::json("error deleting",500);
        }
    
        return \Response::json("success",200);


        //


    }
}
