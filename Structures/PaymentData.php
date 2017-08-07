<?php
namespace DHL\Structures;

class PaymentData {
	private $__paymentData = [
		'paymentMethod' => 'BANK_TRANSFER',
		'payerType' => 'SHIPPER',
		'accountNumber' => \Config::AD_SAP
	];

	public function getPaymentData(): array {
		return $this->__paymentData;
	}
}