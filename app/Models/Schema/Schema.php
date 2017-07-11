<?php

namespace App\Models\Schema;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $connection = 'schema';
    protected $table = 'COLUMNS';
}
