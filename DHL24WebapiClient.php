<?php
namespace DHL;
use SoapClient;
/**
 * Class used to establish connection with DHL API
 */
class DHL24WebapiClient extends SoapClient {
	
	// **Warning** This is only for testing purposes!
	const WSDL = 'https://sandbox.dhl24.com.pl/webapi2';

	// If you want to use it on production server, change api url to 
	//const WSDL = 'https://dhl24.com.pl/webapi2';

	public function __construct() {
		parent::__construct( self::WSDL, array('trace'=> 1));
	}
}