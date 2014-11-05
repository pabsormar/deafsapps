<?php

	include_once './dbInstance.php';
	include_once './gcmInstance.php';

	
	// If there is only one input argument, it would be a message to notify to every user
	if ($argc == 2)
	{
		$message = $argv[1];
		$gcmSuccess = false;
		
		$mDbInstance = new dbInstance;
		$mDbInstance->dbConnect();
		// Get all 'registration IDs' from database
		$userRegIds = $mDbInstance->dbGetAllUsers();
			
		$mGcmInstance = new gcmInstance;
		
		for ($i = 0; $i < mysqli_num_rows($userRegIds); $i++)
		{
			$userArray = mysqli_fetch_row($userRegIds);
			// Send message to devices and getting back a new 'registration ID' in case it has been updated by the GCM server
			$gcmSuccess = $mGcmInstance->sendNotification($userArray, $message);

			if ($gcmSuccess)
			{
 				// If the return value is not '', the entry has to be updated ('dbInsert' with a third argument)
				if ($mGcmInstance->newId != '')
				{
					//echo 'From dbInstance, result: ' . $mGcmInstance->newId . PHP_EOL;
					$resultQuery = $mDbInstance->dbInsert($mGcmInstance->newId, "", $userArray[0]);									
					echo 'Update query result: ' . $resultQuery . PHP_EOL;
					// If '0' is retrieved, no update has been performed, and therefore the entry is repeated
					if ($resultQuery == 0)  
					{
						$resultQuery = $mDbInstance->dbDelete($userArray[0]);
						echo 'Entry deleted' . PHP_EOL;
					}
				}
			}
			else
			{
				if ($mGcmInstance->error != '')
				{
					echo 'From dbInstance, error: ' . $mGcmInstance->error . PHP_EOL;
					$resultQuery = $mDbInstance->dbDelete($userArray[0]);
					echo 'Entry deleted: ' . $resultQuery . PHP_EOL;						
				}
			}
			// Reset 'gcmInstance' values for next iteration
			$mGcmInstance->newId = ''; $mGcmInstance->error = '';			
		}
		
		mysqli_free_result($userRegIds);
				
		$mDbInstance->dbDisconnect();		
	}
	// If there are two input arguments, they would be the message and a group name of users
	elseif ($argc == 3) { }
	else
		echo 'One or two input arguments must be passed to the script!!' . PHP_EOL;

?>
