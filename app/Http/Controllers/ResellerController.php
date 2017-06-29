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
    
    private function formatData($data) {
        $result = array();
        foreach($data as $k=>$v) {
            $result[$v['reseller']] = $v['count'];
        }
        return $result;
    }
    
    public function getExtensions($page) {
        Paginator::currentPageResolver(function() use ($page) {
            return $page; 
        });
        return Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('reseller.companyName')
            ->paginate(25);
    }
    
    public function getExtensionChart() {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('reseller.companyName')
            ->limit(25)
            ->get();
    
        return $this->formatData($results);
    }
    
    public function getBranches($page) {
        Paginator::currentPageResolver(function() use ($page) {
            return $page;
        });
        return Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'branch.description as context')
            ->orderBy('reseller.companyName', 'ASC')
            ->paginate(25);
    }
    
    public function getBranchChart() {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('reseller.companyName')
            ->limit(25)
            ->get();
        return $this->formatData($results);   
    }
    
    public function getCustomers($page) {
        Paginator::currentPageResolver(function() use ($page) {
           return $page; 
        });
        return Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'customer.companyName AS customer')
            ->orderBy('reseller.companyName', 'ASC')
            ->paginate(25);
    }
    
    public function getCustomerChart() {
        $results = Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName AS reseller, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('reseller.companyName')
            ->limit(25)
            ->get();
        return $this->formatData($results);
    }
    
    public function query($target, $page) {
        switch($target) {
            case "customer":
                return $this->getCustomers($page);
                break;
            case "customerChart":
                return $this->getCustomerChart();
                break;
            case "branch":
                return $this->getBranches($page);
                break;
            case "branchChart":
                return $this->getBranchChart();
                break;
            case "extension":
                return $this->getExtensions($page);
                break;
            case "extensionChart":
                return $this->getExtensionChart();
                break;
            default:
                break;
        }
    }
}