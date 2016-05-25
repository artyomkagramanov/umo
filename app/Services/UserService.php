<?php namespace App\Services;


use App\Contracts\UserServiceInterface;
use Mail;
use App\Models\Registration;
use App\User;

class UserService implements UserServiceInterface {

	public function __construct(Registration $registration, User $user)
	{
		$this->registration = $registration;
		$this->user = $user;
	}

	public function createPreRegistrationRecord( $inputs )
	{
		$email = $inputs['email'];
		Mail::send('emails.register', ['email' => $email], function ($message) use ($email)
		{
			$message->from('support@umo.dev', 'Umo');
		    $message->to($email);
		    $message->subject('Registration link');
		});
		if($this->registration->where('email', $email)->exists()) {
			return true;
		}
		return $this->registration->create(['email' => $email]);
	}

	public function checkRegistrationEmail($b_64_email)
	{
		$email = base64_decode($b_64_email);
		$instance = $this->registration->where('email', $email)->first();
		if(!$instance) return 'The email does not exist.';
		return true;
	}

	public function registerNewUser($inputs)
	{
		$inputs['password'] = bcrypt($inputs['password']);
		return $this->user->create($inputs);
	}

	public function deletePreRegistrationRecord($email)
	{
		return $this->registration->where('email', $email)->delete();
	}

	public function checkIfExists($email)
	{
		return $this->user->where('email', $email)->exists();
	}

	public function getByEmail($email)
	{
		return $this->user->where('email', $email)->first();
	}
}