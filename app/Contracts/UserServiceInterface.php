<?php namespace App\Contracts;

interface UserServiceInterface {

	public function createPreRegistrationRecord( $inputs );

	public function checkRegistrationEmail($b_64_email);

	public function registerNewUser($inputs);

	public function deletePreRegistrationRecord($email);

	public function checkIfExists($email);

	public function getByEmail($email);
	
}