<?php
namespace DHL\Structures;
class ItemToPrint {
	private $__labels = [
		'BLP',
		'LBLP',
		'ZBLP'
	];

	private $__itemToPrint = [
		'item' => []
	];

	public function getItemToPrint($shipmentId, $type = 'protocol') {
		switch($type) {
			case 'protocol': {
				$item = [
					'labelType' => 'LP',
					'shipmentId' => $shipmentId
				];
				array_push($this->__itemToPrint['item'], $item);
				break;
			}
			case 'labels': {
				foreach ($this->__labels as $label) {
					$item = [
							'labelType' => $label,
							'shipmentId' => $shipmentId
					];
					array_push($this->__itemToPrint['item'], $item);
				}
			}
		}

		return $this->__itemToPrint;
	}
}