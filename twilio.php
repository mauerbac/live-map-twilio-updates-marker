<?php
//Twilio Response and logging
//�2012 Matt Auerbach
//Twilio Powered Locator


include ('constants.php');

header("content-type: text/xml");

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";

date_default_timezone_set('America/Chicago'); //set your time zone

//Initialize all variables
$SmsSid = '';
$AccountSid = '';
$From = '';
$To = '';
$Body = '';
$FromCity = '';
$FromState = '';
$FromZip = '';
$FromCountry = '';
$ToCity = '';
$ToState = '';
$ToZip = '';
$ToCountry = '';

//Populate variables(if they exist)
isset($_POST['SmsSid'])?$SmsSid = $_POST['SmsSid']:$SmsSid = '';
isset($_POST['AccountSid'])?$AccountSid = $_POST['AccountSid']:$AccountSid = '';
isset($_POST['From'])?$From = $_POST['From']:$From = '';
isset($_POST['To'])?$To = $_POST['To']:$To = '';
isset($_POST['Body'])?$Body = $_POST['Body']:$Body = '';
isset($_POST['FromCity'])?$FromCity = $_POST['FromCity']:$FromCity = '';
isset($_POST['FromState'])?$FromState = $_POST['FromState']:$FromState = '';
isset($_POST['FromZip'])?$FromZip = $_POST['FromZip']:$FromZip = '';
isset($_POST['FromCountry'])?$FromCountry = $_POST['FromCountry']:$FromCountry = '';
isset($_POST['ToCity'])?$ToCity = $_POST['ToCity']:$ToCity = '';
isset($_POST['ToState'])?$ToState = $_POST['ToState']:$ToState = '';
isset($_POST['ToZip'])?$ToZip = $_POST['ToZip']:$ToZip = '';
isset($_POST['ToCountry'])?$ToCountry = $_POST['ToCountry']:$ToCountry = '';

//connect to  database
$link = mysql_connect(HOST,DB_NAME,DB_PASS);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db(DB_NAME);
	if (!$db_selected) {
		die ('Can\'t use foo : ' . mysql_error());
	}
	$sql= "SET time_zone = 'America/Chicago'";
	mysql_query($sql);



$message = strtolower($_POST['Body']);

$array = explode(" ", $message);
$firstWord= $array[0];
$locationNum=(int)$array[1];


//check for loc keyword, then location code 
//update your locations Lats and Longs and Location Name
 if($firstWord=="loc"){
		
		if($locationNum==1){ //lisa's
			$lat=42.060151;
			$long=-87.675818;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long, fname='Lisas Cafe'"; 
			mysql_query($sql);
			sendSMS("Marker Set to Lisas Cafe");
		}else if($locationNum==2){ //elder
			$lat=42.061212;
			$long=-87.677568;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='Elder'"; 
			mysql_query($sql);
			sendSMS("Marker Set to Elder");
		}else if($locationNum==3){ //bobb
			$lat=42.059474;
			$long=-87.675576;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='Bobb'"; 
			mysql_query($sql);	
			sendSMS("Marker Set to Bobb");
		}else if($locationNum==4){ //mudd library
			$lat=42.058111;
			$long=-87.674686;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='Mudd Library'"; 
			mysql_query($sql);
			sendSMS("Marker Set to Mudd Library");
		}else if($locationNum==5){ //university library
			$lat=42.053165;
			$long=-87.674788;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='University Library'"; 
			mysql_query($sql);
			sendSMS("Marker Set to University Library");
		}else if($locationNum==6){ //the rock
			$lat=42.051555;
			$long=-87.675928;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='The Rock'"; 
			mysql_query($sql);	
			sendSMS("Marker Set to The Rock");
		}else if($locationNum==7){ //the arch
			$lat=42.051252;
			$long=-87.677068;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='The Arch'"; 
			mysql_query($sql);	
			sendSMS("Marker Set to the Arch");
		}else if($locationNum==8){ //sorority quad
			$lat=42.051629;
			$long=-87.679801;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='Sorority Quad'"; 
			mysql_query($sql);	
			sendSMS("Marker Set to sorority quad");
		}else if($locationNum=="clear"){ //clear quad
			$lat=0;
			$long=0;
			$sql = "UPDATE locations SET lat=$lat, `long`=$long , fname='Closed'"; 
			mysql_query($sql);	
			sendSMS("Marker Set has been cleared!");
		}
	}else{
		sendSMS("Unrecognized command! Please try again. Use command loc followed by location code.");
	}
	
function sendSMS($response){

$sendSMS=str_ireplace('&','&amp;',"<Response> \n <Sms> \n ".$response."\n</Sms> \n</Response>");

 echo $sendSMS;
}

?>