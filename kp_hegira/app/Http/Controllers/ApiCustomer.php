<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Customer;
use Illuminate\Support\Facades\Input;

class ApiCustomer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       // header('Access-Control-Allow-Origin: *');
        $customers=Customer::all();
        return \Response::json([
            'data' => $customers
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
        $customer=new Customer;
        $customer->name=Input::get('name');
        $customer->email=Input::get('email');
        $customer->address=Input::get('address');
        $customer->contact=Input::get('contact');
        $success=$customer->save();
    
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
        $customers=Customer::find($id);
        if(is_null($customers))
        { 
            return \Response::json("error saving",500);
        }
    
            return \Response::json($customers,201);
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
        $customer=Customer::find($id);
 
        !is_null(Input::get('name')) ? $customer->name=Input::get('name') : $customer->name;
        !is_null(Input::get('email')) ? $customer->email=Input::get('email') : $customer->email;
        !is_null(Input::get('address')) ? $customer->address=Input::get('address') : $customer->address;
        !is_null(Input::get('contact')) ? $customer->contact=Input::get('contact') : $customer->contact;
    
        $success=$customer->save();
    
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
        $customers=Customer::find($id);
        if(is_null($customers))
        {
            return \Response::json("not found",404);
        }
    
        $success=$customers->delete();
    
        if(!$success)
        {
            return \Response::json("error deleting",500);
        }
    
        return \Response::json("success",200);
    }
}
