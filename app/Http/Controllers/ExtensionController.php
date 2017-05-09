<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Extension as Extension;
use Form;

class ExtensionController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getExtensionIdsByBranchId($branchId) {
        return Extension::select('extensionId')->where('branchId', '=', intval($branchId))->get();
    }
}