<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\UserServiceInterface;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;

class SocialRegisterController extends Controller
{
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
    public function linkedin(UserServiceInterface $userService)
    {
    	$provider = new \League\OAuth2\Client\Provider\LinkedIn([
		    'clientId'          => config('social.linkedin.client_id'),
		    'clientSecret'      => config('social.linkedin.client_secret'),
		    'redirectUri'       => config('social.linkedin.redirect_uri'),
		    'scope' => ['email']
		]);

		if (!isset($_GET['code'])) {

		    // If we don't have an authorization code then get one
		    $authUrl = $provider->getAuthorizationUrl();
		    session(['oauth2state' => $provider->getState()]);
		    header('Location: '.$authUrl);
		    exit;

		// Check given state against previously stored one to mitigate CSRF attack
		}  else {

		    // Try to get an access token (using the authorization code grant)
		    $token = $provider->getAccessToken('authorization_code', [
		        'code' => $_GET['code']
		    ]);

		    // Optional: Now you have a token you can look up a users profile data
		    $email = null;
		    try {

		        // We got an access token, let's now get the user's details
		        $user = $provider->getResourceOwner($token);

		        // Use these details to create a new profile
		        $email = $user->getEmail();
		        if(!$email) {
		        	$result = json_encode(['user' => null]); 
		        	return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		        }
		        $user = $userService->getByEmail($email);
		        if(!$user) {
		        	$result = json_encode(['user' => null]); 
			        return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		        }
		        $this->auth->login($user);
		        $result = json_encode(['user' => $user]); 
		        return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";

		    } catch (\Exception $e) {
		    	$result = json_encode(['user' => null]); 
	        	return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		    }
		}
    }

    public function google(UserServiceInterface $userService)
    {
    	$provider = new \League\OAuth2\Client\Provider\Google([
		    'clientId'     => config('social.google.client_id'),
		    'clientSecret' => config('social.google.client_secret'),
		    'redirectUri'  => config('social.google.redirect_uri'),
		]);

		if (!empty($_GET['error'])) {

		    // Got an error, probably user denied access
		    exit('Got error: ' . $_GET['error']);

		} elseif (empty($_GET['code'])) {

		    // If we don't have an authorization code then get one
		    $authUrl = $provider->getAuthorizationUrl();
		    session(['oauth2state' => $provider->getState()]);
		    header('Location: ' . $authUrl);
		    exit;

		}  else {
		    // Try to get an access token (using the authorization code grant)
		    $token = $provider->getAccessToken('authorization_code', [
		        'code' => $_GET['code']
		    ]);

		    // Optional: Now you have a token you can look up a users profile data
		    try {

		        // We got an access token, let's now get the owner details
		        $ownerDetails = $provider->getResourceOwner($token);
		        $email = $ownerDetails->getEmail();
		        if(!$email) {
		        	$result = json_encode(['user' => null]); 
		        	return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		        }
		        $user = $userService->getByEmail($email);
		        if(!$user) {
		        	$result = json_encode(['user' => null]); 
			        return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		        }
		        $this->auth->login($user);
		        $result = json_encode(['user' => $user]); 
		        return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		    } catch (\Exception $e) {
		    	$result = json_encode(['user' => null]); 
	        	return "<script type='text/javascript'>window.state = {$result}; window.close();</script>";
		    }
		}
    }
}
