<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PosModel;
class CobaController extends Controller
{
    //
    public function index(){

    	$username= cobaModel::all();
    	dd($username);
    	return view('cobaView/coba');
    }
    public function show($id){
    	
    	//$alert='<script>alert("hmmm")</script>';
    	// $cats=DB::table('login')->get(); //select
    	/* DB::table('login')->insert([
			['username'=> 'ham', 'password'=>'8294']
    	]);*/ //insert
    	/*DB::table('login')->where('user_id','4')->update(
    		['username'=> 'ham', 'password'=>'8294']);*/ //update
    	$cats=DB::table('login')->get();
    	//dd($cats);
    	return view('cobaView/coba', ['var'=> $id, 'cats'=>$cats]);
    }
}
