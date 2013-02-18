<?php

/* 
 * File: asset_search.php
 * Desc: page to search for a asset
 */
 session_start();
 if ($_SESSION['auth'] != "yes") {
    header("Location: login_form.php");
    exit();
}
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
        include("asset_search_layout.inc");
        exit();
    } //end if blanks found
	
    include("dbconnector.inc");
    $cxn = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
    $query = "SELECT `Asset`.`AssetNo` AS 'Asset Number',
					`Asset`.`Manufacturer`,
					`Asset`.`Model`,
					`Asset`.`Status`,
					`Asset`.`Location`,
					`Asset`.`LastAudit` AS 'Last Audit Date',
					`Asset`.`Type`,
					`Asset`.`DisposalDate` AS 'Disposal Date',
					`Asset`.`DisposalReason` AS 'Disposal Reason',
					`Asset`.`LoanDate` AS 'Loan Date',
					`Asset`.`LoanReason` AS 'Load Reason',
					`Asset`.`ReturnDate` AS 'Return Date',
					`Asset`.`Comments`,
					`Employee`.`EmployeeName` AS 'Assigned User'
					FROM `Asset`
					LEFT JOIN `AssetEmployee` ON `Asset`.`AssetNo`=`AssetEmployee`.`AssetNo`
					LEFT JOIN `Employee` ON `AssetEmployee`.`EmployeeID`=`Employee`.`EmployeID`
					WHERE `EmployeeName` LIKE '%$_POST[asset_search]%'
					OR `Location` LIKE '%$_POST[asset_search]%'
					OR `Asset`.`AssetNo` LIKE '%$_POST[asset_search]%'
					OR `Manufacturer` LIKE '%$_POST[asset_search]%'
					OR `Status` LIKE '%$_POST[asset_search]%'
					OR `Model` LIKE '$_POST[asset_search]%'
					OR `Type` LIKE '%$_POST[asset_search]%'";
    $result = mysqli_query($cxn, $query) or die("Couldn't execute query, {$query}");
    $n_row = mysqli_num_rows($result);
    if ($n_row < 1) {
        $message = "<p style='color: red; margin-bottom: 0; font-weight: bold'>
            No assets found.</p>";
        $extract($_POST);
        include("asset_search_layout.inc");
        exit();
    } 
	else {
	echo "<h1>Search Results</h1>";
	echo "<form action='test_edit.php' method='POST'>\n";
	echo "<table>";
	echo "<tr>";
	echo "<th>Asset Number</th>";
	echo "<th>Manufacturer</th>";
	echo "<th>Model</th>";
	echo "<th>Status</th>";
	echo "<th>Location</th>";
	echo "<th>Last Audit Date</th>";
	echo "<th>Type</th>";
	echo "<th>Disposal Date</th>";
	echo "<th>Disposal Reason</th>";
	echo "<th>Loan Date</th>";
	echo "<th>Loan Reason</th>";
	echo "<th>Return Date</th>";
	echo "<th>Comments</th>";
	echo "<th>Assigned User</th>";
	echo "</tr>";
	while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>".$row['Asset Number']."</td>";
	echo "<td>".$row['Manufacturer']."</td>";
	echo "<td>".$row['Model']."</td>";
	echo "<td>".$row['Status']."</td>";
	echo "<td>".$row['Location']."</td>";
	echo "<td>".$row['Last Audit Date']."</td>";
	echo "<td>".$row['Type']."</td>";
	echo "<td>".$row['Disposal Date']."</td>";
	echo "<td>".$row['Disposal Reason']."</td>";
	echo "<td>".$row['Loan Date']."</td>";
	echo "<td>".$row['Loan Reason']."</td>";
	echo "<td>".$row['Return Date']."</td>";
	echo "<td>".$row['Comments']."</td>";
	echo "<td>".$row['Assigned User']."</td>";
	echo "<td><a href=test_edit.php>Edit</a></td>";
	echo "</tr>";
	}
	#$_SESSION['AssetNumber'] = .$row['Asset Number'].
	echo "</table>\n";
	echo "</form>";
	}
echo "<p><a href=index.php>Back to home page</a></p>";
	} 
else {
$asset_search = "";
include("asset_search_layout.inc");
}
?>