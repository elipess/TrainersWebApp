<?php 


	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";
	
  $tableName = "EDIT_CLIENTS_DETAILS";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  $con = mysql_connect($servername,$username,$password);
  $dbs = mysql_select_db($dbname, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT 'ID' FROM $tableName WHERE CLIENT_ACTIVE = 1"); 
  $numofclients = mysql_num_rows($result);  //query
  $month_year= date("F-Y");  
  $todays_day= date("d");  
  $array = mysql_fetch_row($numofclients);                          //fetch result    
  //echo $numofclients;
  //echo $month_year;
  //echo $todays_day;

  echo json_encode(array("activeClients" =>$numofclients,"month_year" => $month_year, "todays_day" => $todays_day)); 
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  //echo json_encode($array);

?>
