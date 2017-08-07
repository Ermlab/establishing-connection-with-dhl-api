<?php
class DHL24_webapi_client extends SoapClient {
	const WSDL = 'https://sandbox.dhl24.com.pl/webapi2';

	public function __construct() {
		parent::__construct( self::WSDL );
	}
}