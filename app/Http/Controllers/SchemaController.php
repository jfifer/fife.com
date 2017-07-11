<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as Request;
use App\Models\Schema\Schema as Schema;
use Form;

class SchemaController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function query($table) {
        return Schema::selectRaw("COLUMN_NAME as `column`, DATA_TYPE as `type`, COLUMN_KEY as `key`")
            ->where('TABLE_NAME', '=', "$table")
            ->get();
    }
    
    public function getParams($params) {
        parse_str($params, $output);
        return $output;
    }
}