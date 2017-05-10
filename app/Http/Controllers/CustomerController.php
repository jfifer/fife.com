<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Customer as Customer;
use Form;

class CustomerController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function query($target, $type, $attrA) {
        switch($target) {
            case "extension" :
                return $this->doExtensions($type, $attrA);
                break;
            default :
                break;
        }
    }
}