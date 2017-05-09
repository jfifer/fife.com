<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $connection = 'portal';
    protected $table = 'inventory';
    protected $primaryKey = 'inventoryId';
    
    public function inventory() {
        return $this->belongsTo('App\Models\Portal\Inventory', 'inventoryId', 'parentInventoryId');
    }
    
    public function reseller() {
        return $this->hasOne('App\Models\Portal\Reseller', 'resellerId', 'resellerId');
    }
}
