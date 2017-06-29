<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator as Paginator;
use Illuminate\Http\Request as Request;
use App\Models\Portal\Reseller as Reseller;
use App\Models\Portal\Customer as Customer;
use Form;

class ResellerController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getCustomers($page) {
        Paginator::currentPageResolver(function() use ($page) {
           return $page; 
        });
        return Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'customer.companyName AS customer')
            ->paginate(10);
    }
    
    public function getCustomerChart() {
        $results = Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName AS reseller, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('reseller.companyName')
            ->limit(25)
            ->get();
        $data = array();
        foreach($results as $k=>$v) {
            $data[$v['reseller']] = $v['count'];
        }
        return $data;
    }
    
    public function query($target, $page) {
        switch($target) {
            case "customer":
                return $this->getCustomers($page);
                break;
            case "customerChart":
                return $this->getCustomerChart();
                break;
            default:
                break;
        }
    }
}