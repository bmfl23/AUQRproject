<?php

$username = "bmf0008";

$database = "AUQR_ifcDB";

$password = "Bboy23";

mysql_connect("acadmysql.duc.auburn.edu", $username, $password);
mysql_select_db($database) or die("There was an error connecting to database");

// // $sql = "CREATE TABLE MyGuests (
// // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
// // firstname VARCHAR(30) NOT NULL,
// // lastname VARCHAR(30) NOT NULL,
// // email VARCHAR(50),
// // reg_date TIMESTAMP
// // )";
// // 
// //  mysql_select_db('Greek');
// //    $retval = mysql_query( $sql, $conn );
// //    
// //    if(! $retval ) {
// //       die('Could not create table: ' . mysql_error());
// //    }
// //    
// //    echo "Table employee created successfully\n";
//    
$entryNum = 0;
$userEmail = isset($_GET["userEmail"]) ? $_GET["userEmail"] : "Scan Failure";
$senderEmail = isset($_GET["senderEmail"]) ? $_GET["senderEmail"] : "Email Failure";
$eventName = isset($_GET["eventName"]) ? $_GET["eventName"] : "Empty Event Name";
$location = isset($_GET["location"]) ? $_GET["location"] : "Location Failure";
$timeStamp = isset($_GET["timeStamp"]) ? $_GET["timeStamp"] : "Timestap Failure";
$orgName = isset($_GET["orgName"]) ? $_GET["orgName"] : "Orginization Failure";

$now = new DateTime(null, new DateTimeZone('America/Chicago'));
$date = $now->format('Y-m-d H:i:s');    // MySQL datetime format
//echo $now->getTimestamp();
// 
// // $senderEmail = "SenderEmail@gmail.com";
// // $userEmail = "UserEmail@gmail.com";
// // $eventName = "Test Event";
// // $location = "123 Test Street";
// // $time = "";
// 
// 
$query = "INSERT INTO auqr_scannedevents (entryNum, senderEmail, orgName, userEmail, eventName, location, timeStamp) VALUES ('','$senderEmail', '$orgName', '$userEmail', '$eventName', '$location', '$date')";
//print($query);
mysql_query($query) or die("pleaseWork");

mysql_close();

?>