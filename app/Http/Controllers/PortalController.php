<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Models\Portal\Server as Server;
use Form;

class PortalController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function getFeatureServers() {
      //$servers = Portal::where('serverTypeId', 3)->join('voipPlatform', 'server.platformId', '=', 'voipPlatform.voipPlatformId')->get();
      $servers = Server::where('serverTypeId', '=', 3)->get();
      foreach($servers as $k=>$server) {
        //$platform = Server::find($server->serverId)->voipPlatform()->first();
        $servers[$k]->platform = $this->getPlatforms($server->serverId);
      }
      return $servers;
    }
    
    public function getPlatforms($id) {
        return Server::find($id)->voipPlatform()->first();
    }
    
    public function query(Request $request) {
        print_r($request);
    }

    public function index() {
        $view = view('portal');
        return $view;
    }
}

