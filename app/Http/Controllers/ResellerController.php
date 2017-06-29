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
    
    private function getExtensions($page, $limit, $orderby) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page; 
        //});
        return Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit)
            ->get();
    }
    
    private function getExtensionChart($limit, $orderby) {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit)
            ->get();
    
        return $this->formatData($results);
    }
    
    private function getBranches($page, $limit, $orderby) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page;
        //});
        return Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'branch.description as context')
            ->orderBy('reseller.companyName', $orderby)
            ->limit($limit)
            ->get();
    }
    
    private function getBranchChart($limit, $orderby) {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit)
            ->get();
        return $this->formatData($results);   
    }
    
    private function getCustomers($page, $limit, $orderby) {
        //Paginator::currentPageResolver(function() use ($page) {
        //   return $page; 
        //});
        return Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'customer.companyName AS customer')
            ->orderBy('reseller.companyName', $orderby)
            ->limit($limit)
            ->get();
    }
    
    private function getCustomerChart($limit, $orderby) {
        $results = Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName AS reseller, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit)
            ->get();
        return $this->formatData($results);
    }
    
    public function query($target, $limit, $orderby, $page) {
        switch($target) {
            case "customer":
                return $this->getCustomers($page, $limit, $orderby);
                break;
            case "customerChart":
                return $this->getCustomerChart($limit, $orderby);
                break;
            case "branch":
                return $this->getBranches($page, $limit, $orderby);
                break;
            case "branchChart":
                return $this->getBranchChart($limit, $orderby);
                break;
            case "extension":
                return $this->getExtensions($page, $limit, $orderby);
                break;
            case "extensionChart":
                return $this->getExtensionChart($limit, $orderby);
                break;
            default:
                break;
        }
    }
}