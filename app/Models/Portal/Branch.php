<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $connection = 'portal';
    protected $table = 'branch';
    protected $primaryKey = 'branchId';
    
    public function reseller() {
        return $this->belongsTo('App\Models\Portal\Reseller', 'resellerId', 'resellerId');
    }
    
    public function customer() {
        return $this->hasOne('App\Models\Portal\Customer', 'customerId', 'customerId');
    }
    
    public function server() {
        return $this->hasOne('App\Models\Portal\Server', 'featureServerId', 'serverId');
    }
    
    public function extension() {
        return $this->hasMany('App\Models\Portal\Extension', 'branchId', 'branchId');
    }
    
    public function sipTrunk() {
        return $this->hasMany('App\Models\Portal\SIPTrunk', 'branchId', 'branchId');
    }
}
