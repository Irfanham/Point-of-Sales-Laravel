<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleTransaction extends Model
{
    public function warehouse(){
    	return $this->belongsTo('App\Warehouse');
    }
    public function saledetail(){
    	return $this->belongsTo('App\SaleDetail');
    }
    
}
