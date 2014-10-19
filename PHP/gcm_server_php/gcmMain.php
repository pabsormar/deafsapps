<?php

	include_once './dbInstance.php';
	
	$mDbInstance = new dbInstance;
	
	$mDbInstance->dbConnect();
	
	$mDbInstance->dbUpdate(19, 'mariajo');
	$mDbInstance->dbDelete(15);
	
	$mDbInstance->dbDisconnect();

?>