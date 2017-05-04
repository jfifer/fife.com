<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'portal';
    protected $table = 'address';
    protected $primaryKey = 'addressId';
    
    public function reseller() {
        return $this->belongsTo('App\Models\Portal\Reseller', 'addressId', 'addressId');
    }
}
