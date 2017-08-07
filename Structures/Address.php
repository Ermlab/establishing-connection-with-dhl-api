<?php
namespace DHL\Structures;
class Address {
	private $__senderAddressData = [
		'country' => 'PL',
		'name' => 'Jan Kowalski',
		'postalCode' => '10001',
		'city' => 'Olsztyn',
		'street' => 'Test',
		'houseNumber' => '99',
		'contactPerson' => 'Jan Kowalski',
		'contactEmail' => 'jkowalski@example.net',
	];

	private $__receiverAddressData = [
		'country' => 'PL',
		'name' => 'Janina Nowak',
		'postalCode' => '00999',
		'city' => 'Warszawa',
		'street' => 'Test',
		'houseNumber' => '99',
		'contactPerson' => 'Janina Nowak',
		'contactEmail' => 'jnowak@example.net',
	];

	public function getReceiverAddressData(): array {
		return $this->__receiverAddressData;
	}

	public function getSenderAddressData(): array {
		return $this->__senderAddressData;
	}
}