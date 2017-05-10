<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Branch as Branch;
use Form;

class BranchController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getExtensionCountByReseller($resellerId, $extensionTypeId) {
        $branches = Branch::select('branchId')
            ->where('resellerId', '=', intval($resellerId));
        $branches = $branches->get();
        $count = 0;
        foreach($branches as $k=>$branch) {
            $Extension = new ExtensionController();
            $count += sizeof($Extension->getExtensionIdsByBranchId($branch['branchId'], $extensionTypeId));
        }
        return $count;
    }
    
    private function doExtensions($type, $attrA) {
        $branches = Branch::select('branchId')->take(25)->get();
        foreach($branches as $k=>$branch) {
            $Extension = new ExtensionController();
            $branches[$k]->count = sizeof($Extension->getExtensionIdsByBranchId($branch['branchId'], $attrA));
        }
        return $branches;
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