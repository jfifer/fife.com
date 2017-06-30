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
    
    private function getExtensions($page, $limit, $orderby, $filter) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page; 
        //});
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count');
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        $results->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit);
        return $results->get();
    }
    
    private function getExtensionChart($limit, $orderby, $filter) {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('reseller.companyName as reseller, COUNT(*) as count');
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        $results->orderBy('count', $orderby)
            ->groupBy('reseller.companyName')
            ->limit($limit);
        return $this->formatData($results->get());
    }
    
    private function getBranches($page, $limit, $orderby, $filter) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page;
        //});
        DB::connection('portal')->enableQueryLog();
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'branch.description as context')
            ->orderBy('reseller.companyName', $orderby);
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        $results->limit($limit);
        return $results->get();
    }
    
    private function getBranchChart($limit, $orderby, $filter) {
        $results = Reseller::join('branch', 'branch.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName AS reseller, COUNT(*) as count')
            ->orderBy('count', $orderby);
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        return $this->formatData($results->limit($limit)->groupBy('reseller.companyName')->get());
    }
    
    private function getCustomers($page, $limit, $orderby, $filter) {
        //Paginator::currentPageResolver(function() use ($page) {
        //   return $page; 
        //});
        $results = Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->select('reseller.companyName AS reseller', 'customer.companyName AS customer');
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        $results->orderBy('reseller.companyName', $orderby)
            ->limit($limit);
        return $results->get();
    }
    
    private function getCustomerChart($limit, $orderby, $filter) {
        $results = Reseller::join('customer', 'customer.resellerId', '=', 'reseller.resellerId')
            ->selectRaw('reseller.companyName AS reseller, COUNT(*) as count');
        if($filter != '0') {
            $results->where('reseller.companyName', 'LIKE', $filter.'%');
        }
        $results->orderBy('count', $orderby)
            ->limit($limit);
        return $this->formatData($results->limit($limit)->groupBy('reseller.companyName')->get());
    }
    
    public function query($target, $limit, $orderby, $filter, $page) {
        switch($target) {
            case "customer":
                return $this->getCustomers($page, $limit, $orderby, $filter);
                break;
            case "customerChart":
                return $this->getCustomerChart($limit, $orderby, $filter);
                break;
            case "branch":
                return $this->getBranches($page, $limit, $orderby, $filter);
                break;
            case "branchChart":
                return $this->getBranchChart($limit, $orderby, $filter);
                break;
            case "extension":
                return $this->getExtensions($page, $limit, $orderby, $filter);
                break;
            case "extensionChart":
                return $this->getExtensionChart($limit, $orderby, $filter);
                break;
            default:
                break;
        }
    }
}