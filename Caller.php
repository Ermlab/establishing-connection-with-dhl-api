<?php
/**
 * This file is used to redirect links from index.html to appriopriate methods with parameters
 */
	use DHL\Dhl24;
	include 'DHL24.php';
	include 'Config.php';

	if(isset($_GET['action'])){
		$dhl = new DHL24();
		switch ($_GET['action']) {
			case 'getVersion': $dhl->getVersion(); break;
			case 'createShipments': $dhl->createShipments(Config::C_SHIPMENT_DATE); break;
			case 'getLabels': $dhl->getLabels(Config::C_SHIPMENT_ID, 'labels'); break;
			case 'getProtocol': $dhl->getLabels(Config::C_SHIPMENT_ID, 'protocol'); break;
			case 'bookCourier': $dhl->bookCourier(Config::C_SHIPMENT_ID, Config::C_SHIPMENT_DATE); break;
		}
	}