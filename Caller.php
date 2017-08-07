<?php
	use DHL\Dhl24;
	include 'Dhl24.php';
	include 'Config.php';

	if(isset($_GET['action'])){
		$dhl = new Dhl24();
		switch ($_GET['action']) {
			case 'getVersion': $dhl->getVersion(); break;
			case 'createShipments': $dhl->createShipments(Config::C_SHIPMENT_DATE); break;
			case 'getLabels': $dhl->getLabels(Config::C_SHIPMENT_ID, 'labels'); break;
			case 'getProtocol': $dhl->getLabels(Config::C_SHIPMENT_ID, 'protocol'); break;
			case 'bookCourier': $dhl->bookCourier(Config::C_SHIPMENT_ID, Config::C_SHIPMENT_DATE); break;
		}
	}