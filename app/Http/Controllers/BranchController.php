<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Branch as Branch;
use Form;

class BranchController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getExtensionCountByReseller($resellerId, $extensionTypeId, $status) {
        $branches = Branch::select('branchId')
            ->where('resellerId', '=', intval($resellerId));
        $branches = $branches->get();
        $count = 0;
        $validBranches = [];
        if(intval($status) > 0) {
            foreach($branches as $k=>$branch) {
                $Customer = new CustomerController();
                if($Customer->getBranchCustomerStatus($branch['branchId'], $status)) {
                    array_push($validBranches, array('branchId'=>$branch['branchId']));
                }
            }
        } else { $validBranches = $branches; }
        
        foreach($validBranches as $k=>$branch) {
            $Extension = new ExtensionController();
            $extensions = $Extension->getExtensionsByBranchId($branch['branchId'], $extensionTypeId);
            if($extensions) {
                $count += sizeof($extensions);
            }
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