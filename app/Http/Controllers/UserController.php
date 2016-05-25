<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use App\Contracts\UserServiceInterface;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view( 'accounts.index' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserServiceInterface $userService)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function preRegister(Request $request, UserServiceInterface $userService)
    {
        if($userService->checkIfExists($request->get('email'))) {
            return response()->json(['status' => 'error', 'message' => 'This email already in use.']);
        }
    	if($userService->createPreRegistrationRecord($request->all())) {
    		return response()->json(['status' => 'success', 'message' => 'Please check your email.']);
    	}
    	return response()->json(['status' => 'error', 'message' => 'Something went wrong please try again.']);
    }

    public function registerCheck(Request $request, UserServiceInterface $userService)
    {
        $res = $userService->checkRegistrationEmail($request->get('email'));
        if($res !== true) {
            return response()->json(['status' => 'error', 'message' => $res]);            
        }
        return response()->json(['status' => 'success', 'resource' => ['email' => base64_decode($request->get('email'))]]);
    }

    public function register(RegistrationRequest $request, UserServiceInterface $userService)
    {
        $user = $userService->registerNewUser($request->all());
        $userService->deletePreRegistrationRecord($request->get('email'));
        $this->auth->login( $user );
        return response()->json(['status' => 'success', 'resource' => ['user' => $user]]);
    }

    public function getAuthUser()
    {
        return response()->json(['status' => 'success', 'resource' => ['user' => $this->auth->user()]]);
    }

    public function logout()
    {
        $this->auth->logout();
        return response()->json(['status' => 'success']);
    }

    public function doLogin(LoginRequest $request)
    {
        if($this->auth->attempt($request->all())){
            return response()->json(['status' => 'success', 'resource' => ['user' => $this->auth->user()]]);
        }
        return response()->json(['status' => 'error', 'message' => 'Wrong credentials.']);
    }
}