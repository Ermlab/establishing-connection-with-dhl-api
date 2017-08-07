<?php
namespace DHL\Structures;

include 'Address.php';
include 'Piece.php';
include 'PaymentData.php';
include 'ServiceDefinition.php';
class ShipmentFullData {
	private $__address;
	private $__piece;
	private $__paymentData;
	private $__serviceDefinition;

	public function __construct() {
		$this->__address = new Address();
		$this->__piece = new Piece();
		$this->__paymentData = new PaymentData();
		$this->__serviceDefinition = new ServiceDefinition();
	}

	public function getShipmentFullData($shipmentDate) {
		$data['item'] = [
			'shipper' => $this->__address->getSenderAddressData(),
			'receiver' => $this->__address->getReceiverAddressData(),
			'pieceList' => [
				'item' => $this->__piece->getPieceDefinition()
			],
			'payment' => $this->__paymentData->getPaymentData(),
			'service' => $this->__serviceDefinition->getServiceDefinition(),
			'shipmentDate' => $shipmentDate,
			'content' => 'Something',
			'skipRestrictionCheck' => true
		];

		return $data;
	}
}