<?php
namespace DHL\Structures;
class Piece {
	private $__pieceDefinition = [
		'type' => 'PACKAGE',
		'width' => 80,
		'height' => 40,
		'length' => 40,
		'weight' => 15,
		'quantity' => 1,
		'nonStandard' => false
	];

	public function getPieceDefinition() {
		return $this->__pieceDefinition;
	}
}