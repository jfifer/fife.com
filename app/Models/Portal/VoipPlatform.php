<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class VoipPlatform extends Model
{
    protected $connection = 'portal';
    protected $table = 'voipPlatform';
    protected $primaryKey = 'voipPlatformId';
    protected $fillable = ['voipPlatformId', 'name'];
    
    public function server() {
        return $this->belongsTo('App\Models\Portal\Server', 'voipPlatformId', 'platformId');
    }
}
