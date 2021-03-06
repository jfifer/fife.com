var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Reseller', ['$resource',
  function ($resource) {
    return $resource('/portal/reseller/:target/:type/:attrA', { target: "@target", type: "@type", attrA: "@attrA" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);

appSrv.factory('Branch', ['$resource',
  function ($resource) {
    return $resource('/portal/branch/:target/:type/:attrA', { target: "@target", type: "@type", attrA: "@attrA" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);