<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Reseller as Reseller;
use Form;

class ResellerController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    private function doExtensions($type) {
        $resellers = Reseller::select('resellerId', 'companyName')->get();
        foreach($resellers as $k=>$reseller) {
            $resellerId = $reseller['resellerId'];
            $Branch = new BranchController();
            $resellers[$k]->extensionCount = $Branch->getExtensionCountByReseller($resellerId);
        }
        return $resellers;
    }
    
    public function query($type, $target) {
        /**
         *
         * Cloud = ExtensionTypeId=2
         * Standard = ExtensionTypeId=1
         *
         **/
        switch($target) {
            case "extension" :
                return $this->doExtensions($type);
                break;
            default :
                break;
        }
    }
}