angular.module('umo')
  .controller('MainController', MainController)

  MainController.$inject = ['$http', '$scope', '$rootScope', '$route', '$location', 'inform', '$window', '$interval'];

    function MainController($http, $scope, $rootScope, $route, $location, inform, $window, $interval) {
    	$scope.logout = logout;
    	$scope.doLogin = doLogin;
    	$scope.inputs = {};
    	$scope.loginWithLinkedin = loginWithLinkedin;
    	$scope.loginWithGoogle = loginWithGoogle;
    	$rootScope.$on('$routeChangeStart', function(next, current) {
    	var guest = undefined;
		if(current.$$route) {
    		var guest = current.$$route.guest;
		}
        if ($rootScope.user !== undefined) {
        	$scope.user = $rootScope.user;
            if (guest) {
                return passGuest();
            } else {
                return passAuth();
            }
        } else {
            // e.preventDefault();
            $http.get('api/get-auth-user').then(function(data){
            	$rootScope.user = data.data.resource.user;
                $scope.user = $rootScope.user;
            });
           
        }
    });

    function passGuest(e) {
        if ($rootScope.user !== null) {
            // e.preventDefault();
            $location.path('/');
            return false;
        }
    }

    function logout() {
    	$http.get('api/logout').then(function(data){
           	$rootScope.user = null;
            $scope.user = null;
            $location.path('/login');
        });	
    }

    function passAuth(e) {
        if ($rootScope.user === null) {
            // e.preventDefault();
            $location.path('/login');
            return false;
        }
    }

    function doLogin() {
        $http.post("api/login", $scope.inputs).then(function(data){
            if(data.data.status == 'success') {
                $rootScope.user = data.data.resource.user;
                $scope.user = $rootScope.user
                $location.path('/calculate');
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

    function loginWithLinkedin(){
        var width = 500;
        var height = 500;
        var left=($window.screen.width/2)-(width/2);
        var top=($window.screen.height/2)-(height/2);
        var win = $window.open("linkedin-callback", "Linkedin", 'height='+height+',width='+width+',top='+top+',left='+left);
        var interval = $interval(function(){
            try{

                if(win.state)
                {
                	var user = win.state.user;
                	if(user) {
	                	$rootScope.user = user;
	                	$scope.user = $rootScope.user;
    	            	$location.path('/calculations');

                	} else {
		     			inform.add('Wrong credentials.', {
	                        "type": "danger"
		                });
                	}
                    $interval.cancel(interval);
	     		}
	     		// $location.path('/calculations');
            } catch(err){}},1000)
        
    }

        function loginWithGoogle(){
        var width = 500;
        var height = 500;
        var left=($window.screen.width/2)-(width/2);
        var top=($window.screen.height/2)-(height/2);
        var win = $window.open("google-callback", "Google", 'height='+height+',width='+width+',top='+top+',left='+left);
        var interval = $interval(function(){
            try{

                if(win.state)
                {
                	var user = win.state.user;
                	if(user) {
	                	$rootScope.user = user;
	                	$scope.user = $rootScope.user;
    	            	$location.path('/calculations');

                	} else {
		     			inform.add('Wrong credentials.', {
	                        "type": "danger"
		                });
                	}
                    $interval.cancel(interval);
	     		}
	     		// $location.path('/calculations');
            } catch(err){}},1000)
        
    }

    
};