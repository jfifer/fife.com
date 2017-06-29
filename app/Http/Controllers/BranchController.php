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
    
    private function getExtensions($page) {
        Paginator::currentPageResolver(function() use ($page) {
            return $page; 
        });
        return Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('branch.description')
            ->paginate(25);
    }
    
    private function getExtensionChart() {
        $results = Branch::join('extension', 'extension.branchId', '=', 'branch.branchId')
            ->selectRaw('branch.description as context, COUNT(*) as count')
            ->orderBy('count', 'DESC')
            ->groupBy('branch.description')
            ->limit(25)
            ->get();
        return $this->formatData($results);
    }
    
    public function query($target, $page) {
        switch($target) {
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