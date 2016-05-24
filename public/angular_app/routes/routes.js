angular.module('umo').config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        templateUrl: 'angular_app/templates/auth/login.html',
        controller: 'AuthController'
      }).
      when('/login', {
        templateUrl: 'angular_app/templates/auth/login.html',
        controller: 'AuthController'
      }).
      when('/register', {
        templateUrl: 'angular_app/templates/auth/register.html',
        controller: 'AuthController',
        controllerAs: 'auth'
      }).
      when('/calculate', {
        templateUrl: 'angular_app/templates/calculate/index.html',
        controller: 'CalculateController',
        controllerAs: 'calculate'
      }).
      when('/calculate/create', {
        templateUrl: 'angular_app/templates/calculate/create.html',
        controller: 'CalculateController',
        controllerAs: 'calculate'
      }).

      otherwise({
        redirectTo: '/'
      });
  }]);