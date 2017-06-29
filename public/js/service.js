var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Reseller', ['$resource',
  function ($resource) {
    return $resource('/portal/reseller/:target/:page', { target: "@target", page: "@page" }, {
      get: { method: 'GET', isArray: false }
    });
  }]);

appSrv.factory('ResellerChart', ['$resource',
  function ($resource) {
    return $resource('/portal/reseller/:target/:type', { target: "@target", page: "@page" }, {
      get: { method: 'GET', isArray: false }
    });
  }]);

appSrv.factory('Branch', ['$resource',
  function ($resource) {
    return $resource('/portal/branch/:target/:type/:attrA/:attrB', { target: "@target", type: "@type", attrA: "@attrA", attrB: "@attrB" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);

appSrv.factory('Extension', ['$resource',
  function ($resource) {
    return $resource('/portal/extension/:target/:type/:attrA/:attrB', { target: "@target", type: "@type", attrA: "@attrA", attrB: "@attrB" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);