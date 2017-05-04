<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $connection = 'portal';
    protected $table = 'server';
    protected $primaryKey = 'serverId';
    protected $fillable = ['serverId', 'hostname'];
    
    public function voipPlatform() {
        return $this->hasOne('App\Models\Portal\VoipPlatform', 'voipPlatformId', 'platformId');
    }
    
    public function serverGroup() {
        return $this->belongsTo('App\Models\Portal\ServerGroup', 'serverTypeId', 'serverTypeId');
    }
}
