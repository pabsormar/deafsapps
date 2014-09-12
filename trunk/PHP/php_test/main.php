<?php
  
  // Create an array to be JSON-encoded
  //$mArray = array("Pablo" => "Sordo", "Marta" => "Sordo", "Miquel" => "Aguirre");
  $mArray = array("Sordo", "Sordo", "Aguirre");
  header("Content-type: application/json");
  echo json_encode(array("mArray" => $mArray));
  
?>