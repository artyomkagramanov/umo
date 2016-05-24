angular.module('umo')
  .controller('CalculateController', CalculateController)

  CalculateController.$inject = ['$http'];

    function CalculateController($http) {
    	var vm = this;

    	vm.save = save;
    	vm.calc = calc;
    	vm.hasError = false;
    	var pi = 3.14159265359;


        
        function init() {
        	// alert(555);
        }

        function save()
        {
        	if(vm.hasError || !vm.height || !vm.radius) {
        		return false;
        	}
        	var inputs = { 
        		height:vm.height,
        		radius:vm.radius,
        		volume:vm.result
        	};
        	$http.post('api/calculate', inputs).then(function(data){

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