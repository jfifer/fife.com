<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Customer as Customer;
use Form;

class CustomerController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getBranchCustomerStatus($branchId, $status) {
        $customers = Customer::select('customerId', 'companyName');
        if(intval($status) === 1) {
            $customers->where('statusId', '=', 1);
        } else {
            $customers->whereIn('statusId', [2,3]);
        }
        $customers = $customers->get();
        
        if($customers && sizeof($customers) > 0) {
            return true;
        }
        return false;
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