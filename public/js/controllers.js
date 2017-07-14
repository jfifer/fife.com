var appCtrl = angular.module('appCtrl', []);

appCtrl.controller('homeController', function ($scope, Schema, Query) {
  $scope.columns = [];
  $scope.query = {};
  $scope.crap = [];
  $scope.resCols = [];
  $scope.results = [];
  $scope.includes = [];
  $scope.i = 0;
  
  $scope.getObjLength = function(obj) {
    columns = [];
    angular.forEach(obj, function(k, v) { columns.push(v); });
    return columns;
  };
  
  $scope.parseUrlString = function(obj) {
    str = "";
    for (var key in obj) {
      if (str != "") {
          str += "&";
      }
      str += key + "=" + encodeURIComponent(obj[key]);
    }
    return str;
  };
  
  $scope.updateColumns = function(schema) {
    Schema.get({ schema: schema }, function(res) {
      $scope.columns = res;
    });
  };
  
  $scope.submitQuery = function(query) {
    includes = [];
    angular.forEach(query.eloquent_includes, function(key, val) {
      includes.push(val);
    });
    query.eloquent_includes = $scope.parseUrlString({ 'eloquent': includes });
    Query.post({ params: $scope.parseUrlString(query) }, function(res) {
      $scope.results = res;
      $scope.resCols = $scope.getObjLength(res);
    });
  };
});