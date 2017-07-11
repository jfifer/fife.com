var appCtrl = angular.module('appCtrl', []);

appCtrl.controller('homeController', function ($scope, Schema) {
  $scope.columns = [];
  $scope.query = {};
  $scope.i = 0;
  
  $scope.updateColumns = function(schema) {
    Schema.get({ schema: schema }, function(res) {
      $scope.columns = res;
    });
  };
  
  $scope.submitQuery = function(query) {
    console.log(query);
  };
});