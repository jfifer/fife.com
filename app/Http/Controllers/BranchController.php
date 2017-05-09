<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Branch as Branch;
use Form;

class BranchController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getExtensionCountByReseller($resellerId) {
        $branches = Branch::select('branchId')->where('resellerId', '=', intval($resellerId))->get();
        $count = 0;
        foreach($branches as $k=>$branch) {
            $Extension = new ExtensionController();
            $count += sizeof($Extension->getExtensionIdsByBranchId($branch['branchId']));
        }
        return $count;
    }
}