var appCtrl = angular.module('appCtrl', []);

appCtrl.controller('homeController', function ($scope, Schema, Query) {
  $scope.columns = [];
  $scope.query = {};
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
    Query.post({ params: $scope.parseUrlString(query) }, function(res) {
      console.log(res);
    });
  };
});