<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }

    public function warehouse(){
        return $this->belongsTo('App\Warehouse');
    }
}
