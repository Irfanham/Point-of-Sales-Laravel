<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $date=date('l, d F Y . H:i:s ');
        return view ('PosView/dashboard',['date'=>$date]);
    }
    public function show(){
        return view('PosView/master');
    }
    public function pelanggan(){
        return view('PosView/pelanggan');
    }
    public function pembelian(){
        return view('PosView/pembelian');
    }
    public function pemasok(){
        return view('PosView/pemasok');
    }
    public function gudang(){
        return view('PosView/gudang');
    }
    public function laporan(){
        return view('PosView/laporan');
    }
    public function tambahUser(){
        return view('PosView/tambahUser');
    }
}
