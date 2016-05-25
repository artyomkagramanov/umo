angular.module('umo').config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        name:'home',
        templateUrl: 'angular_app/templates/auth/login.html',
        controller: 'AuthController'
      }).
      when('/login', {
        guest:true,
        templateUrl: 'angular_app/templates/auth/login.html',
        controller: 'AuthController',
        controllerAs: 'auth'
      }).
      when('/register', {
        guest:true,
        name: 'preRegister',
        templateUrl: 'angular_app/templates/auth/pre-register.html',
        controller: 'AuthController',
        controllerAs: 'auth'
      }).
      when('/register/:id', {
        guest:true,
        name:'register',
        templateUrl: 'angular_app/templates/auth/register.html',
        controller: 'AuthController',
        controllerAs: 'auth'
      }).
      when('/calculate', {
        guest:false,
        name:'calculateIndex',
        templateUrl: 'angular_app/templates/calculate/index.html',
        controller: 'CalculateController',
        controllerAs: 'calculate'
      }).
      when('/calculate/create', {
        guest:false,
        templateUrl: 'angular_app/templates/calculate/create.html',
        controller: 'CalculateController',
        controllerAs: 'calculate'
      }).
      when('/calculate/:id/edit', {
        guest:false,
        name:'calculateEdit',
        templateUrl: 'angular_app/templates/calculate/edit.html',
        controller: 'CalculateController',
        controllerAs: 'calculate',
      }).

      otherwise({
        redirectTo: '/'
      });
  }]);