<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portal\Server as Server;
use App\Models\Portal\VoipPlatform as Platform;
use Form;

class PortalController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function getFeatureServers() {
      //$servers = Portal::where('serverTypeId', 3)->join('voipPlatform', 'server.platformId', '=', 'voipPlatform.voipPlatformId')->get();
      $servers = Server::where('serverTypeId', '=', 3)->get();
      return $servers;
    }
    
    public function getPlatforms() {
        $platforms = Platform::all();
        return $platforms;
    }

    public function index() {
        $data['servers'] = $this->getFeatureServers();
        $data['platforms'] = $this->getPlatforms();
        $view = view('portal')->with('data', $data);
        return $view;
    }
}

