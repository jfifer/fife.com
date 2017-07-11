var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Schema', ['$resource',
  function ($resource) {
    return $resource('/schema/schema/:schema', { schema: "@schema" }, {
      get: { method: 'GET', isArray: true },
      post: { method: 'POST', isArray: false }
    });
  }]);