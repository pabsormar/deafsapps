<?php

	include_once './dbInstance.php';
	include_once './gcmInstance.php';

	
	// If there is only one input argument, it would be a message to notify to every user
	if ($argc == 2)
	{
		$message = $argv[1];
		//echo 'Message: ' . $message . PHP_EOL;
		
		$mDbInstance = new dbInstance;
		$mDbInstance->dbConnect();
		// Get all 'registration IDs' from database
		$userRegIds = $mDbInstance->dbGetAllUsers();
			
		$mGcmInstance = new gcmInstance;
		
		for ($i = 0; $i < mysqli_num_rows($userRegIds); $i++)
		{
			$newRegId = "";			

			$userArray = mysqli_fetch_row($userRegIds);
			if ($i == 3)
			{
				// Send message to devices and getting back a new 'registration ID' in case it has been updated by the GCM server
				$newRegId = $mGcmInstance->sendNotification($userArray, $message);
 				// If the return value is not "", the database is updated ('dbInsert' with a third argument)
				if ($newRegId != "")
				{
					echo 'From dbInstance, result: ' . $newRegId . PHP_EOL;
					$mDbInstance->dbInsert($newRegId, "", $userArray[0]);									
				}
			}
		}

		// Get all 'registration IDs' from database to delete duplicates
                $userRegIds = $mDbInstance->dbGetAllUsers();
		if (mysqli_num_rows($userRegIds) > 1)
		{
			echo "Number of matches: " . mysqli_num_rows($userRegIds) . PHP_EOL;
			for ($i = 0; $i < mysqli_num_rows($userRegIds)-1; $i++)
			{
				echo "iteration: $i" . PHP_EOL;
				$userArray = mysqli_fetch_row($userRegIds);
				//$mDbInstance->dbDelete($userArray[0]);
			}

		}
		
		mysqli_free_result($userRegIds);
				
		$mDbInstance->dbDisconnect();		
	}
	// If there are two input arguments, they would be the message and a group name of users
	elseif ($argc == 3)
	{
	
	}
	else
		echo 'One or two input arguments must be passed to the script!!' . PHP_EOL;

?>
