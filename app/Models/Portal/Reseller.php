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
    
    public function address() {
        return $this->hasOne('App\Models\Portal\Address', 'addressId', 'addressId');
    }
    
    public function serverGroup() {
        return $this->hasMany('App\Models\Portal\ServerGroup', 'resellerId', 'resellerId');
    }
}
