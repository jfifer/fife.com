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
    
    private function getExtensions($page, $limit, $orderby) {
        //Paginator::currentPageResolver(function() use ($page) {
        //    return $page; 
        //});
        return Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('branch.description')
            ->limit($limit)
            ->get();
    }
    
    private function getExtensionChart($limit, $orderby) {
        $results = Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count')
            ->orderBy('count', $orderby)
            ->groupBy('branch.description')
            ->limit($limit)
            ->get();
        return $this->formatData($results);
    }
    
    public function query($target, $limit, $orderby, $page) {
        switch($target) {
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