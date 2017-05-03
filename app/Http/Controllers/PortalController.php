<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portal as Portal;

class PortalController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function getFeatureServers() {
      $servers = Portal::where('serverTypeId', 3)->join('voipPlatform', 'server.platformId', '=', 'voipPlatform.voipPlatformId')->get();
      return $servers;
    }

    public function index() {
        $result = $this->getFeatureServers();
        $view = view('portal')->with('servers', $result);
        return $view;
    }
}

