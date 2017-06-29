<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Extension as Extension;
use Form;

class ExtensionController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getExtensionsByBranchId($branchId, $extensionTypeId) {
        $extensions = Extension::select('extensionId')
            ->where('branchId', '=', intval($branchId));
        if(intval($extensionTypeId) > 0) {
            $extensions = $extensions->where('extensionTypeId', '=', intval($extensionTypeId));
        }
        return $extensions->get();
    }
}