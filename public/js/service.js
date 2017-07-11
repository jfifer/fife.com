var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Schema', ['$resource',
  function ($resource) {
    return $resource('/schema/schema/:schema', { schema: "@schema" }, {
      get: { method: 'GET', isArray: true },
      post: { method: 'POST', isArray: false }
    });
  }]);

appSrv.factory('Query', ['$resource',
  function ($resource) {
    return $resource('/schema/schema/query/:params', { params: "@params" }, {
      get: { method: 'GET', isArray: true },
      post: { method: 'POST', isArray: true }
    });
  }]);