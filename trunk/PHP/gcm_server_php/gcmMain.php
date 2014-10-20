<?php

	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	$mDbInstance = new dbInstance;
	
	$mDbInstance->dbConnect();
	
	$mDbInstance->dbUpdate(19, 'mariajo');
	$mDbInstance->dbDelete(15);
	
	$mDbInstance->dbDisconnect();

?>