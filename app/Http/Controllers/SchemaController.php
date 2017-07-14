<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as Request;
use App\Models\Schema\Schema as Schema;
use App\Models\Portal\Reseller as Reseller;
use App\Models\Portal\Customer as Customer;
use App\Models\Portal\Branch as Branch;
use App\Models\Portal\Extension as Extension;
use App\Models\Portal\Server as Server;
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
        parse_str(rawurldecode($params), $output);
        $includes = explode(",", explode("=", $output['eloquent_includes'])[1]);
        unset($output['eloquent_includes']);
        $from = $output['select'];
        unset($output['select']);
        $query = null;
        switch($from) {
            case "reseller":
                $query = Reseller::select($includes);
                break;
            case "customer":
                $query = Customer::select($includes);
                break;
            case "branch":
                $query = Branch::select($includes);
                break;
            case "extension":
                $query = Extension::select($includes);
                break;
            case "server":
                $query = Server::select($includes);
                break;
            default:
                break;
        }
        foreach($output as $k=>$v) {
            $query->where("$k", "=", "$v");
        }
        return $query->get();
    }
}