<!DOCTYPE html>
<html lang="en" ng-app='umo' ng-controller='MainController'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="bower_components/angular-inform/dist/angular-inform.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
            <div inform class="inform-animate inform-fixed inform-shadow"></div>

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="/#/">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    
                        <li ng-if='!user'><a href="#/login">Login</a></li>
                        <li ng-if='!user'><a href="#/register">Register</a></li>
                        <li ng-if='user'><a href="">Hi @{{ user.first_name }}</a></li>
                        <li ng-if='user' ng-click='logout()'><a href=""><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="body-container">
        <ng-view></ng-view>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/bower_components/angular/angular.min.js"></script>
    <script src="/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="/bower_components/angular-inform/dist/angular-inform.min.js"></script>
    <script src="/bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="/angular_app/app.js"></script>
    <script src="/angular_app/routes/routes.js"></script>
    <script src="/angular_app/controllers/AuthController.js"></script>
    <script src="/angular_app/controllers/MainController.js"></script>
    <script src="/angular_app/controllers/CalculateController.js"></script>
    <script src="https://code.angularjs.org/1.4.5/angular-route.js"> </script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
