<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>New Appointment</title>
	<link rel="Stylesheet"
		  type="text/css"
		  href="my_style.css">  
</head>


	<?php
extract ($_POST);

// Create connection

$host = "localhost";
$dbusername = "msuri1";
$dbpassword = "mayhah";
$dbname = "g2";
	  
$database = new mysqli($host, $dbusername, $dbpassword, $dbname);  
 if ($database->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
if ($database->connect_error) 
	   {
    die("Connection failed: " . $conn->connect_error);
} 
	if ($database) {
  	echo 'connected';
	} 	
	else {
  echo 'not connected';
	}		

//this is the new part that I can't figure out
	//if (! ($result = $database->query("SELECT Cust_Phone FROM Customer WHERE Cust_Phone = '$phone'") ) )
	//print("Warning - select failed<br>");
	//$row=$result->fetch_assoc();
	//$phone = $row["Cust_Phone"];
	//if (! if $result > 0){
		//print("not found");
	
//make sure the phone number exists
	if (! ($result = $database->query("SELECT Cust_Phone FROM Customer WHERE Cust_Phone = '$phone'") ) )
	print("Warning - could not get phone<br>");
	$row = $result->fetch_assoc();
	$custid = $row["Cust_ID"];
// Get customer ID from phone number
if (! ($result = $database->query("SELECT Cust_ID FROM Customer WHERE Cust_Phone = '$phone'") ) )
	print("Warning - could not get id<br>");
	$row = $result->fetch_assoc();
	$custid = $row["Cust_ID"];
//Add Time (done)
if (! ($result = $database->query("SELECT Appt_Time_ID FROM TimeRanges WHERE TimeRanges_Name = '$time'") ))
	print("Warning - could not get id<br>");
	$row = $result->fetch_assoc();
	$timeid = $row["Appt_Time_ID"];
//Add Service (draft1) not working
if (! ($result = $database->query("SELECT Appt_Services_ID FROM Services WHERE Services_Name = '$servicename'") ) )
	print("Warning - could not get id<br>");
	$row = $result->fetch_assoc();
	$serviceid = $row["Appt_Services_ID"];
//Add Month (done)
if (! ($result = $database->query("SELECT Appt_Month_ID FROM Month_Table WHERE Month_Name = '$monthname'") ) )
	print("Warning - could not get id<br>");
	$row = $result->fetch_assoc();
	$monthid = $row["Appt_Month_ID"];
//Add Date d1
if (! ($result = $database->query("SELECT Appt_Date_ID FROM Date_Table WHERE Date_Date = '$datedate'") ) )
	print("Warning - could not get id<br>");
	$row = $result->fetch_assoc();
	$dateid = $row["Appt_Date_ID"];

//insert into Appointments and add the notes(?)
		if (! ($database->query(
			"INSERT INTO 
			Appointments (Appt_Cust_ID,Appt_Month_ID,Appt_Date_ID,Appt_Time_ID,Appt_Services_ID,Appt_Notes) 
			VALUES ('$custid','$monthid','$dateid','$timeid','$serviceid','$apptnotes') ") ) )
			print("Warning - insert failed<br>");
		print(
		"<h1>Confirmation</h1><br>Your $servicename appointment is set for $monthname $datedate from $time. Your appointment ID number will be emailed to you. You can use it to view or modify your existing appointments.Thank you for choosing Pet Ambassadors!<br>"); 
?>
<img src="thank_you_PNG134.png" width="200" height="150" alt="black scrawled text that says Thank You"/>
	<br><a href="http://g2.psjconsulting.com/home.html">Go Home</a>
	<br><a href="http://g2.psjconsulting.com/update_contact_info.html">Update Your Info</a>
	<br><a href="http://g2.psjconsulting.com/modifyAppt.html">View/Modify Existing Appointments</a>
</html> 
	?>
