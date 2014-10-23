<?php

	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	if (isset($_POST[DB_REGID]) && isset($_POST[DB_GROUP]))
	{			
		$regId = $_POST[DB_REGID];
		$group = $_POST[DB_GROUP];
	
		$mDbInstance = new dbInstance;		
		$mDbInstance->dbConnect();		
		$newReferId = $mDbInstance->dbInsert($regId, $group);		
		$mDbInstance->dbDisconnect();		
	}
	else
		echo 'No input data' . PHP_EOL;
?>
