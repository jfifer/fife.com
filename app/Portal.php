<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $connection = 'portal';
    protected $table = "server";
    protected $fillable = ['hostname'];
}
