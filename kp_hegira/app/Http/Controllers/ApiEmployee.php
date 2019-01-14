<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Employee;
use Illuminate\Support\Facades\Input;

class ApiEmployee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees=Employee::all();
        return response()->json([
            'data'=>$employees
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
        $employees=new Employee;
        $employees->name=$request->input('name');
        $employees->email=$request->input('email');
        $employees->password=$request->input('password');
        $employees->status=$request->input('status');
        $employees->contact=$request->input('contact');
        $success=$employees->save();
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
        $employees=Employee::find($id);
        if(is_null($employees)){
            return response()->json('not found',404);
        } return response()->json($employees,200);
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
        $employees=Employee::find($id);
        !is_null($request->input('name'))?$employees->name=$request->input('name'):$employees->name;
        !is_null($request->input('name'))?$employees->email=$request->input('email'):$employees->email;
        !is_null($request->input('password'))?$employees->password=$request->input('password'):$employees->password;
        !is_null($request->input('status'))?$employees->status=$request->input('status'):$employees->status;
        !is_null($request->input('contact'))?$employees->contact=$request->input('contact'):$employees->contact;
        $success=$employees->update();
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
        $employees=Employee::find($id);
        if(is_null($employees)){
            return response()->json('not found',404);
        }
        $success=$employees->delete();
        if(!$success){
            return response()->json('error',500);
        }   return response()->json('success',200);  


    }
}
