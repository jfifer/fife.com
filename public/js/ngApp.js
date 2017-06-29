var app = angular.module('ngApp', [
    'appCtrl',
    'appDirectives',
    'appSrv',
    'ui.bootstrap'
], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
