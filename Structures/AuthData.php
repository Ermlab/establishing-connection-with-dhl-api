<?php
namespace DHL\Structures;

class AuthData {
	private $__authData = [
		'username' => \Config::AD_USERNAME,
		'password' => \Config::AD_PASSWORD
	];

	public function getAuthData() {
		return $this->__authData;
	}
}