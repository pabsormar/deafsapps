<?php
    // Replace with the real server API key from Google APIs
	define('GOOGLE_API_KEY', 'AIzaSyCoDqoODh55jMEMLFA9DU3yENLXG3LA1Xk');

    // Replace with the real client registration IDs
    $registrationIDs = array("APA91bHni70zbet4PWX2Q0x5aHgXW83bBU4ZKCxWSWqT5Kg4o0sQsCk2yDC2epshmfutCPFlyvXsdyVvKgQ06bvdOz50ZFoOiEyRpWDT023fk3or93bWEZOIXyaqeXqcxhrqW9h9-Hu0JpjylZlmqIva1Px9VrKs_EGK-Hc5WqLA8NhGYLqVGTA");
    // $registrationIDs = array("APA91bEhpgSb1ksvZpWZ0G7amew7Vb_fsaZeoxkcOxJI6oc952rEivZ2M-nneWiXKqkiGXAf_d_1u-MZoLa8VYOwazr1R_fJWkEv3vI-YWcdN5xoS5r72YDPCAFe-QoDZ2l8ipsikJPAcT_-HfQ3TcItMKcEEKNn7KRYGGeAFYl-APF8pUOcZ0c");
	
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