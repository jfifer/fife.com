var app = angular.module('ngApp', [
    'appCtrl',
    'appDirectives',
    'appSrv'
], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
