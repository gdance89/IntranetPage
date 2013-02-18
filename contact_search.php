<?php

/* 
 * File: contact_search.php
 * Desc: page to search for a contact
 */



 
 session_start();
if (isset($_POST['searchfor']) && $_POST['searchfor'] == "yes") {
 foreach ($_POST as $field => $value) {
        if ($value == "") {
            $blank_array[$field] = $value;
        } else {
            $good_data[$field] = strip_tags(trim($value));
        }
    } //end foreach look
    if (@sizeof($blank_array) > 0) {
        $message = "<p style='color: red; margin-bottom: 0; font-weight: bold;'>
            You must enter something to search for.</p>";
        extract($blank_array);
        extract($good_data);
        include("contact_search_layout.inc");
        exit();
    } //end if blanks found
	
    include("dbconnector.inc");
    $cxn = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
    $query = "SELECT `Employee`.`EmployeeName` AS 'Name', 
					`Employee`.`Office`, 
					`Employee`.`JobTitle` AS 'Job Title', 
					`Employee`.`PhoneNo` AS 'Phone Number', 
					`Employee`.`MobileNo` AS 'Mobile Number', 
					`Employee`.`Email`,
					`Asset`.`AssetNo` AS 'Asset Number'
					FROM `Employee`
					LEFT JOIN `AssetEmployee` ON `Employee`.`EmployeID`=`AssetEmployee`.`EmployeeID`
					LEFT JOIN `Asset` ON `AssetEmployee`.`AssetNo`=`Asset`.`AssetNo`
                    WHERE `EmployeeName` LIKE '%$_POST[contact_search]%'
					OR `Office` LIKE '%$_POST[contact_search]%'
					OR `PhoneNo` LIKE '%$_POST[contact_search]%'
					OR `MobileNo` LIKE '%$_POST[contact_search]%'
					OR `JobTitle` LIKE '%$_POST[contact_search]%'";
    $result = mysqli_query($cxn, $query) or die("Couldn't execute query, {$query}");
    $n_row = mysqli_num_rows($result);
   	?>
	<html>
<head>
<title>Contact Search Page</title>
<?php require('navigation.inc');?>
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>
	<?php
	 if ($n_row < 1) {
        include("contact_search_layout.inc");
        $message = "<p>No contacts found.</p>";
        $extract($_POST);
        exit();
    } 
	else {
	echo "<div id='leftmenu'>"; 
	echo "<p>Site Navigation</p>";
	sidebar();
	echo "</div>";
	echo "<div id='pagebody'>";
	echo "<h1>Search Results</h1>";
	echo "<table>";
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>Office</th>";
	echo "<th>Job Title</th>";
	echo "<th>Phone Number</th>";
	echo "<th>Mobile Number</th>";
	echo "<th>Email</th>";
	if ($_SESSION['AccessLevel'] == "IT" 
	or $_SESSION['AccessLevel'] == "HR"
	or $_SESSION['AccessLevel'] == "Manager"){
	echo "<th>Asset Number</th>";
	}
	echo "</tr>";
	while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>".$row['Name']."</td>";
	echo "<td>".$row['Office']."</td>";
	echo "<td>".$row['Job Title']."</td>";
	echo "<td>".$row['Phone Number']."</td>";
	echo "<td>".$row['Mobile Number']."</td>";
	echo "<td>".$row['Email']."</td>";
	if ($_SESSION['AccessLevel'] == "IT" 
	or $_SESSION['AccessLevel'] == "HR"
	or $_SESSION['AccessLevel'] == "Manager"){
	echo "<td>".$row['Asset Number']."</td>";
	echo "<td><a href=index.php>Edit</a></td>";
	}
	echo "</tr>";
	}
	echo "</table>\n";
	}
echo "<p><a href=index.php>Back to home page</a></p>";
echo "</div>";
echo "</body></html>";
	} 
else {
$contact_search = "";
include("contact_search_layout.inc");
}
?>