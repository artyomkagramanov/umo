angular.module('umo')
  .controller('MainController', MainController)

  MainController.$inject = ['$http', '$scope', '$rootScope'];

    function MainController($http, $scope, $rootScope) {
        $scope.user = $rootScope.user;
};