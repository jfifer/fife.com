<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $connection = 'portal';
    protected $table = 'reseller';
    protected $primaryKey = 'resellerId';
    
    public function branch() {
        return $this->hasMany('App\Models\Portal\Branch', 'resellerId', 'resellerId');
    }
    
    public function customer() {
        return $this->hasMany('App\Models\Portal\Customer', 'resellerId', 'resellerId');
    }
    
    public function extension() {
        return $this->hasManyThrough('App\Models\Portal\Extension', 'App\Models\Portal\Branch', 'branchId', 'branchId', 'resellerId');
    }
    
    public function address() {
        return $this->hasOne('App\Models\Portal\Address', 'addressId', 'addressId');
    }
    
    public function serverGroup() {
        return $this->hasMany('App\Models\Portal\ServerGroup', 'resellerId', 'resellerId');
    }
    
    public function sipTrunk() {
        return $this->hasMany('App\Models\Portal\SIPTrunk', 'resellerId', 'resellerId');
    }
    
    public function inventory() {
        return $this->hasMany('App\Models\Portal\Inventory', 'resellerId', 'resellerId');
    }
}
