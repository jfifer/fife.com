<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'portal';
    protected $table = 'customer';
    protected $primaryKey = 'customerId';
    
    public function reseller() {
        return $this->belongsTo('App\Models\Portal\Branch', 'resellerId', 'resellerId');
    }
    
    public function sipTrunk() {
        return $this->hasOne('App\Models\Portal\SIPTrunk', 'customerId', 'customerId');
    }
}
