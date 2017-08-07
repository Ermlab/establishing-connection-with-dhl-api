<?php
	include 'Dhl24.php';

	if(isset($_GET['action'])){
		$dhl = new Dhl24();
		$dhl->getVersion();
	}