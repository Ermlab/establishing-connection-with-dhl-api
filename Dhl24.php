<?php
namespace DHL;
use DHL\Structures\AuthData;
use DHL\Structures\ItemToPrint;
use DHL\Structures\ShipmentFullData;

include 'DHL24_webapi_client.php';
include 'Structures/AuthData.php';
include 'Structures/ShipmentFullData.php';
include 'Structures/ItemToPrint.php';
class Dhl24 {
	private $__client;
	private $__authData;

	public function __construct() {
		$this->__client =  new DHL24_webapi_client();
		$this->__authData = new AuthData();
	}

	public function getVersion() {
		$result = $this->__client->getVersion();
		print_r($result);
	}

	public function createShipments($shipmentDate) {
		$shipments = new ShipmentFullData();
		$params = [
			'authData' => $this->__authData->getAuthData(),
			'shipments' => $shipments->getShipmentFullData($shipmentDate)
		];
		$this->__client->createShipments($params);
		$this->__saveFiles();
	}

	public function getLabels($shipmentId, $type) {
		$itemToPrint = new ItemToPrint();
		$params = [
			'authData' => $this->__authData->getAuthData(),
			'itemsToPrint' => $itemToPrint->getItemToPrint($shipmentId, $type)
		];
		$result = $this->__client->getLabels($params);

		$this->__saveLabels($result, $type);
	}

	public function bookCourier($shipmentId, $shipmentDate) {
		$params = [
			'authData' => $this->__authData->getAuthData(),
			'pickupDate' => $shipmentDate,
			'pickupTimeFrom' => '10:00',
			'pickupTimeTo' => '16:00',
			'shipmentIdList' => [
				$shipmentId
			]
		];
		$this->__client->bookCourier($params);

		$this->__saveFiles();
	}

	private function __saveFiles() {
		$time_stamp = time();
		file_put_contents('requests/' . 'request_' . $time_stamp . '.xml', $this->__client->__getLastRequest());
		file_put_contents('requests/' . 'response_' . $time_stamp . '.xml', $this->__client->__getLastResponse());
	}

	private function __saveLabels($data, $type) {
		if($type == 'protocol')
			$labels = $data->getLabelsResult;
		else
			$labels = $data->getLabelsResult->item;

		foreach ($labels as $label) {
			file_put_contents('labels/' . $label->labelName, base64_decode($label->labelData));
		}
	}
}
