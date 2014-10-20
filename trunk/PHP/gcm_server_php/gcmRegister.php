<?php
	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	if (isset($_POST[DB_REFERID]) && isset($_POST[DB_REGID]))
	{			
		$referId = $_POST[DB_REFERID];
		$regId = $_POST[DB_REGID];
	
		$mDbInstance = new dbInstance;		
		$mDbInstance->dbConnect();		
		$newReferId = $mDbInstance->dbUpdate($referId, $regId);		
		$mDbInstance->dbDisconnect();
		
		if (mysqli_num_rows($newReferId))
		{
			// Create an array to be JSON-encoded
			$mArray = array("$newReferId");
			header("Content-type: application/json");
			echo json_encode(array("mArray" => $mArray));
		}		
	}
	else
		echo 'No input data';
?>