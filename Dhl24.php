<?php
include 'DHL24_webapi_client.php';
class Dhl24 {
	private $__client;

	public function __construct() {
		$this->__client =  new DHL24_webapi_client();
	}

	public function getVersion() {
		$result = $this->__client->getVersion();
		print_r($result);
	}
}
