var appSrv = angular.module('appSrv', ['ngResource']);

appSrv.factory('Portal', ['$resource',
  function ($resource) {
    return $resource('api/portal/:method', { method: "@method", id: "@id" }, {
      post: { method: 'POST', isArray: true },
      get: { method: 'GET', isArray: false }
    });
  }]);