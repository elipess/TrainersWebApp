<?php

if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "addmeasurement": 
             {
		insert_to_db();
		break;
             }
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
  $return = $_POST;
    
  $return["json"] = json_encode($return);

  echo json_encode($return);
}

function insert_to_db(){
	
	$date = date("Y-m-d ");
	$bmi = $_POST['bmi'];
	$fat = $_POST['fat_persentege'];
    $weight = $_POST['weight'];
	
	// Create connection
	$conn = new mysqli("localhost", "", "", "");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO PROGRESS_TABLE_NOT_DB ( BMI, FAT_PERCENTAGE, WEIGHT, INSERT_DATE)
	VALUES ( '$bmi', '$fat', '$weight', '$date')";

	if ($conn->query($sql) === TRUE) {
		  $return = $_POST;
                  $return["json"] = json_encode($return);
                   echo json_encode($return);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();	
}
?>