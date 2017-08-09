<?php
namespace DHL;
use DHL\Structures\AuthData;
use DHL\Structures\ItemToPrint;
use DHL\Structures\ShipmentFullData;

include 'DHL24WebapiClient.php';
include 'Structures/AuthData.php';
include 'Structures/ShipmentFullData.php';
include 'Structures/ItemToPrint.php';
/**
 * Class using to create request to API
 */
class DHL24 {
	private $__client;
	private $__authData;

	
	public function __construct() {
		$this->__client =  new DHL24WebapiClient();
		$this->__authData = new AuthData();
	}
	/**
	 * Getting information about current version of API
	 *
	 * @return xml
	 */
	public function getVersion() {
		$result = $this->__client->getVersion();
		return $result;
	}

	/**
	 * Creating shipment in DHL system
	 *
	 * @param [date] $shipmentDate
	 * @return void
	 */
	public function createShipments($shipmentDate) {
		$shipments = new ShipmentFullData();
		$params = [
			'authData' => $this->__authData->getAuthData(),
			'shipments' => $shipments->getShipmentFullData($shipmentDate)
		];
		$this->__client->createShipments($params);
		$this->__saveFiles();
	}

	/**
	 * Getting waybill and thermal labels from API
	 *
	 * @param [date] $shipmentId
	 * @param [string] $type
	 * @return void
	 */
	public function getLabels($shipmentId, $type) {
		$itemToPrint = new ItemToPrint();
		$params = [
			'authData' => $this->__authData->getAuthData(),
			'itemsToPrint' => $itemToPrint->getItemToPrint($shipmentId, $type)
		];
		$result = $this->__client->getLabels($params);

		$this->__saveLabels($result, $type);
	}

	/**
	 * Booking courier for shipment pickup
	 *
	 * @param [int] $shipmentId
	 * @param [date] $shipmentDate
	 * @return void
	 */
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

	/**
	 * Saving requests and responses from API to .xml files
	 *
	 * @return void
	 */
	private function __saveFiles() {
		$time_stamp = time();
		file_put_contents('requests/' . 'request_' . $time_stamp . '.xml', $this->__client->__getLastRequest());
		file_put_contents('requests/' . 'response_' . $time_stamp . '.xml', $this->__client->__getLastResponse());
	}

	/**
	 * Saving waybill and thermal labels from API to files with label type extension
	 *
	 * @param [xml] $data
	 * @param [string] $type
	 * @return void
	 */
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
