angular.module('umo')
  .controller('CalculateController', CalculateController)

  CalculateController.$inject = ['$http', '$location', 'inform', '$route', '$routeParams'];

    function CalculateController($http, $location, inform, $route, $routeParams) {
    	var vm = this;

    	vm.save = save;
    	vm.calc = calc;
    	vm.destroy = destroy;
    	vm.update = update;
    	vm.hasError = false;
    	vm.list = [];
    	var pi = 3.14159265359;


        
        function init() {
        	var routeName = $route.current.$$route.name;

        	if(routeName == 'calculateEdit') {
        		$http.get('api/calculate/'+$routeParams.id).then(function(data){
        			vm.height = data.data.resource.height;
        			vm.radius = data.data.resource.radius;
        			vm.result = data.data.resource.volume;
	        	});
        	} else if(routeName == 'calculateIndex'){
	        	$http.get('api/calculate').then(function(data){
	        		vm.list = data.data.resource;
	        	});
        	}
        }

        function destroy(item) {
        	$http.delete('api/calculate/'+item.id).then(function(data){
        		if(data.data.status == 'success') {
        			vm.list = data.data.resource;
	        		inform.add('Successfuly deleted.', {
	                    "type": "primary"
	                  });
        		}
        	});
        }

        function update() {
        	if(vm.hasError || !vm.height || !vm.radius) {
        		inform.add('Incorrect values.', {
                    "type": "danger"
                  });
        		return false;
        	}
        	var inputs = { 
        		height:vm.height,
        		radius:vm.radius,
        		volume:vm.result
        	};
        	$http.put('api/calculate/'+$routeParams.id, inputs).then(function(data){
        		if(data.data.status == 'success') {
        			vm.list = data.data.resource;
        			$location.path('/calculate');
	        		inform.add('Successfuly updated.', {
	                    "type": "primary"
	                  });
        		}
        	});
        }

        function save()
        {
        	if(vm.hasError || !vm.height || !vm.radius) {
        		inform.add('Incorrect values.', {
                    "type": "danger"
                  });
        		return false;
        	}
        	var inputs = { 
        		height:vm.height,
        		radius:vm.radius,
        		volume:vm.result
        	};
        	$http.post('api/calculate', inputs).then(function(data){
        		if(data.data.status == 'success') {
        			vm.list = data.data.resource;
        			$location.path('/calculate');
	        		inform.add('Successfuly saved.', {
	                    "type": "primary"
	                  });
        		}
        	});
        }

        function calc() {
        	if(vm.radius && vm.height && (isNaN(vm.height) || isNaN(vm.radius))) {
        		vm.hasError = true;

        	} else {
        		vm.hasError = false;
        	}
        	var res = pi * (vm.radius * vm.radius) * (vm.height/3);
        	vm.result = res;
        }

        init();
};