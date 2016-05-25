angular.module('umo')
  .controller('AuthController', AuthController)

AuthController.$inject = ['$http', '$scope', 'inform', '$route', '$routeParams', '$location', '$rootScope'];

function AuthController($http, $scope, inform, $route, $routeParams, $location, $rootScope) {

	var vm = this;
	vm.preRegister = preRegister;
    vm.register = register;
	vm.inputs = {};

    function init() {
        var routeName = $route.current.$$route.name;
        if(routeName == 'register') {
            $http.post("api/register-check", {email:$routeParams.id}).then(function(data) {
                if(data.data.status == 'error') {
                    $location.path('/');
                    inform.add(data.data.message, {
                            "type": "danger"
                    });
                } else if(data.data.status == 'success') {
                    vm.inputs.email = data.data.resource.email;
                }
            });
        } else if(routeName == 'home') {
            if($rootScope.user) {
                $location.path('/calculate');
            } else {
                $location.path('/login');
            }
        }
    }

    function preRegister() {
    	$http.post("api/pre-register", vm.inputs).then(function(data){
            if(data.data.status == 'success') {
                inform.add(data.data.message, {
                        "type": "primary"
                    });
            } else if(data.data.status == 'error') {
                inform.add(data.data.message, {
                        "type": "danger"
                });
            }
    	});
    }

    function register() {
        $http.post("api/register", vm.inputs).then(function(data){
            if(data.data.status == 'success') {
                $rootScope.user = data.data.resource.user;
                $scope.user = $rootScope.user;
                $location.path('/calculate');
                inform.add('Successfully registered.', {
                        "type": "primary"
                    });
            } else if(data.data.status == 'error') {
                inform.add(data.data.message, {
                        "type": "danger"
                });
            }
        }, function(error){
            if(error.status === 422) {
                messages = error.data;
                console.log(messages);
                for(i in messages) {
                    for(j in messages[i]){
                        inform.add(messages[i][j], {
                                "type": "danger"
                        });
                    }
                } 
            }
        });
    }



    init();
};