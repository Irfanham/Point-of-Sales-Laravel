<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    //
    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
    
}
