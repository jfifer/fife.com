var appCtrl = angular.module('appCtrl', []);

appCtrl.controller('homeController', function ($rootScope, $scope, $uibModal, $document, Reseller, ResellerChart, Branch, BranchChart, Extension, ExtensionChart) {
  $scope.results = null;
  $scope.columns = [];
  $scope.query = {};
  $scope.query.limit = 1;
  $scope.query.orderby = "ASC";
  $scope.query.page = 1;
  
  $scope.models = {
    'reseller': Reseller,
    'resellerChart': ResellerChart,
    'branch': Branch,
    'branchChart': BranchChart,
    'extension': Extension,
    'extensionChart': ExtensionChart
  };
  
  $scope.reseller = Reseller;
  
  $scope.getObjLength = function(obj) {
    columns = [];
    angular.forEach(obj, function(k, v) { columns.push(v); });
    return columns;
  };
  
  $scope.submitQuery = function(query) {
    $scope.models[query.from].get({ target: query.select, limit: query.limit, orderby: query.orderBy, page: query.page }, function(res) {
      $scope.results = res;
      $scope.columns = $scope.getObjLength($scope.results[0]);
    });
  };
  
  $scope.generateChart = function(query, type) {
    select = query.select + "Chart";
    from = query.from + "Chart";
    parentSelector = ".modal-parent";
    var parentElem = parentSelector ? angular.element($document[0].querySelector(parentSelector)) : undefined;
      
    $scope.model = $scope.models[query.from+"Chart"];
    $scope.model.get({ target: query.select+"Chart", limit: query.limit, orderby: query.orderBy, type: type }, function(res) {
      res = res.toJSON();
      modalInstance = $uibModal.open({
        animation: true,
        ariaLabelledBy: 'modal-title',
        ariaDescribedBy: 'modal-body',
        templateUrl: 'modal/chart_modal.html',
        controller: 'chartController',
        controllerAs: '$ctrl',
        appendTo: parentElem,
        resolve: {
          query: function () {
            return { 'data': query, 'type': type };
          }
        }
      }).rendered.then(function() {
        $rootScope.$broadcast('modalRendered', res);
      });
    });
  };
});

appCtrl.controller('chartController', function($rootScope, $scope, $uibModalInstance, $timeout, ResellerChart, query) {
  $scope.models = {
    'resellerChart': ResellerChart
  };
  
  $scope.closeModal = function() {
    $uibModalInstance.close();
  };
  
  $scope.args = null;
  
  $scope.drawChart = function() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', query.data.from);
    data.addColumn('number', query.data.select);
    vals = [];
    angular.forEach($scope.args, function(value, key) {
      vals.push([key, parseInt(value)]);
    });
    data.addRows(vals);

    // Instantiate and draw the chart.
    var chart;
    if(query.type === "bar") {
      chart = new google.visualization.BarChart(document.getElementById('ct-chart'));
    } else if(query.type === "pie") {
      chart = new google.visualization.PieChart(document.getElementById('ct-chart'));
    }
    chart.draw(data, null);
  };
  
  $rootScope.$on('modalRendered', function(event, args){
    $scope.series = [];
    $scope.labels = [];
    i = 0;
    
    len = Object.keys(args).length - 2;
    
    angular.forEach(args, function(val, key) {
      if(i < len) {
        $scope.series[i] = parseInt(val);
        $scope.labels[i] = key;
        i++;
      }
    });
    $scope.args = args;
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback($scope.drawChart);
          
  });
});