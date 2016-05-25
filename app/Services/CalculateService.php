<?php namespace App\Services;


use App\Contracts\CalculateServiceInterface;
use App\Models\Calculate;
use Illuminate\Contracts\Auth\Guard;

class CalculateService implements CalculateServiceInterface {

	public function __construct(Calculate $calculate, Guard $auth)
	{
		$this->calculate = $calculate;
		$this->auth = $auth;
	}

	public function create( $inputs )
	{
		$inputs['user_id'] = $this->auth->id();
		return $this->calculate->create($inputs);
	}

	public function getAll()
	{
		return $this->calculate->where('user_id', $this->auth->id())->get();
	}

	public function destroy($id)
	{
		$instance = $this->calculate->find($id);
		if($instance->user_id != $this->auth->id()) {
			return false;
		}
		return $instance->delete();
	}

	public function getbyId($id)
	{
		return $this->calculate->find($id);
	}

	public function update($id, $inputs)
	{
		$instance = $this->calculate->find($id);
		if($instance->user_id != $this->auth->id()) {
			return false;
		}
		return $instance->update($inputs);
	}
}