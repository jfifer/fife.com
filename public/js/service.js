var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Reseller', ['$resource',
  function ($resource) {
    return $resource('/portal/reseller/:target/:limit/:orderby/:page', { target: "@target", limit: "@limit", orderby: "@orderby", page: "@page" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);

appSrv.factory('ResellerChart', ['$resource',
  function ($resource) {
    return $resource('/portal/reseller/:target/:limit/:orderby/:type', { target: "@target", limit: "@limit", orderby: "@orderby", type: "@type" }, {
      get: { method: 'GET', isArray: false }
    });
  }]);

appSrv.factory('Branch', ['$resource',
  function ($resource) {
    return $resource('/portal/branch/:target/:limit/:orderby/:page', { target: "@target", limit: "@limit", orderby: "@orderby", page: "@page" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);

appSrv.factory('BranchChart', ['$resource',
  function ($resource) {
    return $resource('/portal/branch/:target/:limit/:orderby/:type', { target: "@target", limit: "@limit", orderby: "@orderby", type: "@type" }, {
      get: { method: 'GET', isArray: false }
    });
  }]);

appSrv.factory('Extension', ['$resource',
  function ($resource) {
    return $resource('/portal/extension/:target/:limit/:orderby/:page', { target: "@target", limit: "@limit", orderby: "@orderby", page: "@page" }, {
      get: { method: 'GET', isArray: true }
    });
  }]);

appSrv.factory('ExtensionChart', ['$resource',
  function ($resource) {
    return $resource('/portal/extension/:target/:limit/:orderby/:type', { target: "@target", limit: "@limit", orderby: "@orderby", type: "@type" }, {
      get: { method: 'GET', isArray: false }
    });
  }]);