<?php
    // Replace with the real server API key from Google APIs
	define('GOOGLE_API_KEY', 'AIzaSyCoDqoODh55jMEMLFA9DU3yENLXG3LA1Xk');

    // Replace with the real client registration IDs
    $registrationIDs = array("APA91bHXMVfmoOJOjfJpiVYvWnhQ8cbYYDZSAop2Zmx6PtyU-JoCLY691tlepzKb93rC7P-JERH_iW1YPuMnjkMegbdtWWhrpV6JoQBRh9yjQtW4DjaZPM8FhkQ1hlE-iPwh_dThOajD5a6UoTbmJphLqFLnTWpeXzEyOHErKgLTObbZDC5ZHFI");
    // $registrationIDs = array("APA91bE6haKHO7OPkMOtmPUNAAZE0m5wfLttdyMx1ZE-eHZWtDDsNNJ8tb92gS5rPXOIRObSfx902O-1q5bMxeBq63M3WrBvhfxvez53ZnHGTbBAolbq3SE9i2A-jNsDmdbUCmh2vk4semkunElnP5reQlhUvblKCjh2aKkJpPsOAJ0FQTiUeWs");
	
    // Message to be sent
    $message = "Hi, Swansea City fan!!";

    // Set POST variables
    $url = 'https://android.googleapis.com/gcm/send';

    $fields = array('registration_ids' => $registrationIDs, 'data' => array("message" => $message));
    $headers = array('Authorization: key=' . GOOGLE_API_KEY, 'Content-Type: application/json');

    // Open connection
    $ch = curl_init();

    // Set the URL, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    // Execute post
    $result = curl_exec($ch);

    // Close connection
    curl_close($ch);
    echo $result;
    //print_r($result);
    //var_dump($result);
?>