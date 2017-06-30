<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Branch as Branch;
use App\Models\Portal\Extension as Extension;
use App\Models\Portal\Customer as Customer;
use Illuminate\Pagination\Paginator as Paginator;
use Form;

class BranchController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    private function formatData($data) {
        $result = array();
        foreach($data as $k=>$v) {
            $result[$v['context']] = $v['count'];
        }
        return $result;
    }
    
    private function getExtensions($page, $limit, $orderby, $filter) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page; 
        //});
        $results = Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count');
        if($filter != '0') {
            $results->where('branch.description', 'LIKE', $filter.'%');
        }
        return $results->orderBy('count', $orderby)
            ->groupBy('branch.description')
            ->limit($limit)
            ->get();
    }
    
    private function getExtensionChart($limit, $orderby, $filter) {
        $results = Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count');
        if($filter != '0') {
            $results->where('branch.description', 'LIKE', $filter.'%');
        }
        $results->orderBy('count', $orderby)
            ->groupBy('branch.description')
            ->limit($limit);
        return $this->formatData($results->get());
    }
    
    public function query($target, $limit, $orderby, $filter, $page) {
        switch($target) {
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