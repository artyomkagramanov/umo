<?php namespace App\Services;


use App\Contracts\UserServiceInterface;
use Config;
use Mail;

class UserService implements UserServiceInterface {

	public function registerUser( $inputs )
	{
		$email = $inputs['email'];
		// return true;
		// $client = new PostmarkClient( Config::get( 'mail.postmark_api_key' ) );

		// $sendResult = $client->sendEmail(
		// 	"support@umo.com",
		// 	$inputs['email'],
		// 	"Registration link",
		// 	"Please follow this <a href='http://umo.dev/#/user-register/".json_encode($inputs['email'])."'>link</a> to register"
		// );
		Mail::send('emails.register', ['email' => $email], function ($message) use ($email)
		{
			$message->from('support@umo.dev', 'Umo');
		    $message->to($email);
		    $message->subject('Registration link');
		});

		// $status = Postmark\Mail::compose( Config::get( 'mail.postmark_api_key' ) )
		// 	    ->from( 'support@umo.com', 'UMO Support' )
		// 	    ->addTo( $inputs['email'] )
		// 	    ->subject( "Registration link" )
		// 	    ->messageHtml(
		// 	    	"Please follow this <a href='http://umo.dev/#/user-register/".json_encode($inputs['email'])."'>link</a> to register"
		// 	    )->send();
		
		// dd($status);

		return '';
	}
}