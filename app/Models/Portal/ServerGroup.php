<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class ServerGroup extends Model
{
    protected $connection = 'portal';
    protected $table = 'serverGroup';
    protected $primaryKey = 'serverGroupId';
    
    public function server() {
        return $this->hasMany('App\Models\Portal\Server', 'serverTypeId', 'serverTypeId');
    }
    
    public function reseller() {
        return $this->belongsTo('App\Models\Portal\Reseller', 'resellerId', 'resellerId');
    }
}
