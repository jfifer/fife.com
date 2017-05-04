<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    protected $connection = 'portal';
    protected $table = 'extension';
    protected $primaryKey = 'extensionId';
    
    public function branch() {
        return $this->belongsTo('App\Models\Portal\Branch', 'branchId', 'branchId');
    }
}
