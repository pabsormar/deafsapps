<?php
// This file is used to send Push notifications to Android devices by making a request to the GCM server

	include_once './GCM.php';
	$gcm = new GCM();

	$registration_ids = array($regId);
	$message = array("price" => $message);

	// '->' refers to a method of a particular class (like '.' in Java)
	$result = $gcm->send_notification($registration_ids, $message);

	echo $result;

?>