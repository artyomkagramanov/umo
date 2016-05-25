<?php namespace App\Contracts;

interface CalculateServiceInterface {

	public function create( $inputs );

	public function getAll();

	public function destroy($id);

	public function getById($id);

	public function update($id, $inputs);

}