var appCtrl = angular.module('appCtrl', []);

appCtrl.controller('homeController', function ($scope, Reseller, Branch) {
  $scope.results = null;
  $scope.columns = [];
  $scope.models = {
    'reseller': Reseller,
    'branch': Branch
  };
  
  $scope.reseller = Reseller;
  
  $scope.getObjLength = function(obj) {
    columns = [];
    angular.forEach(obj, function(k, v) { columns.push(v); });
    return columns;
  };
  
  $scope.submitQuery = function(groupBy) {
    attr = null;
    switch($scope.model) {
      case "extension" :
        attr = $scope.attr.extType;
        break;
      default :
        break;
    }
    
    $scope.models[groupBy].get({ target: $scope.model, type: $scope.type, attrA: attr }, function(res) {
      $scope.columns = $scope.getObjLength(res[0]);
      $scope.results = res;
    });
  };
});