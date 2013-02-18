<?php
/* File: test_edit.php
 * Desc: test file for editing contacts and assets
 */
 session_start();
 $form_headers = array(	"Asset Number", "Manufacturer", "Model", "Status", "Location",
						"Last Audit Date", "Type", "Disposal Date", "Disposal Reason",
						"Loan Date", "Loan Reason", "Return Date", "Comments", "Assigned User");
 
 echo "<p>Asset number = {$_SESSION['AssetNumber']}</p>";
	
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
					WHERE `Asset`.`AssetNo` = '$id'";
	$result = mysqli_query($cxn, $query) or die("Couldn't execute query, {$query}");
	
	include("datepicker.inc");
	echo "<form action ='datesubmit.php' method='POST'>";
	echo "<table>";
	echo "<tr>";
	foreach ($form_headers as $headers) 
	{
		echo "<th>$headers</th>\n";
	}
	echo "</tr>";
	
	while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td><input type='text' name='Asset Number' value='".$row['Asset Number']."'</td>";
	echo "<td><input type='text' name='Manufacturer' value='".$row['Manufacturer']."'</td>";
	echo "<td><input type='text' name='Model' value='".$row['Model']."'</td>";
	echo "<td>".$row['Status']."</td>";
	echo "<td>".$row['Location']."</td>";
	echo "<td><input type='text' id='datepicker1' name='last_audit_date' 
				value='".$row['Last Audit Date']."' /></td>";
	echo "<td>".$row['Type']."</td>";
	echo "<td><input type='text' id='datepicker2' name='disposal_date'
			value='".$row['Disposal Date']."' /></td>";
	echo "<td><input type='text' name='Disposal Reason' value='".$row['Disposal Reason']."'</td>";
	echo "<td>".$row['Loan Date']."</td>";
	echo "<td><input type='text' name='Loan Reason' value='".$row['Loan Reason']."'</td>";
	echo "<td>".$row['Return Date']."</td>";
	echo "<td><input type='text' name='Comments' value='".$row['Comments']."'</td>";
	echo "<td>".$row['Assigned User']."</td>";
	echo "</tr>";
	}
	echo "</table>\n";
	echo "<input type='submit' value='Submit' />";
	echo "</form>";
echo "<p><a href=index.php>Back to home page</a></p>";

?>