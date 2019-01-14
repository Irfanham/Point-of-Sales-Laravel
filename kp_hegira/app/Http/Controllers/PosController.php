<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\login;
class PosController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function customer(){
        return view('admin.customer');   
    }
    public function sale(){
        return view('admin.sale');
    }
    public function supplier(){
        return view('admin.supplier');
    }
    public function warehouse(){
        return view('admin.warehouse');
    }
}
