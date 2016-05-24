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
        controller: 'AuthController'
      }).

      otherwise({
        redirectTo: '/'
      });
  }]);