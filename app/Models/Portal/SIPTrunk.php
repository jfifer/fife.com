<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class SIPTrunk extends Model
{
    protected $connection = 'portal';
    protected $table = 'sipTrunk';
    protected $primaryKey = 'sipTrunkId';
    
    public function branch() {
        return $this->belongsTo('App\Models\Portal\Branch', 'branchId', 'branchId');
    }
    
    public function reseller() {
        return $this->belongsTo('App\Models\Portal\Reseller', 'resellerId', 'resellerId');
    }
    
    public function customer() {
        return $this->belongsTo('App\Models\Portal\Customer', 'customerId', 'customerId');
    }
}
