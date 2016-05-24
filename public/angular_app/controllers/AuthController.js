angular.module('umo')
  .controller('AuthController', AuthController)

AuthController.$inject = ['$http', '$scope'];

function AuthController($http, $scope) {

	var vm = this;
	vm.register = register;
	vm.inputs = {};

    function init() {
    }

    function register() {
    	$http.post("api/register", vm.inputs).then(function(data){
    		console.log(data);
    	});
    }

    init();
};