<?php
namespace DHL\Structures;
class ServiceDefinition {
	private $__serviceDefinition = [
		'product' => 'AH',
		'deliveryEvening' => false,
		'insurance' => true,
		'insuranceValue' => 150
	];

	public function getServiceDefinition(): array {
		return $this->__serviceDefinition;
	}
}