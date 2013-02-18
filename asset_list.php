<?php
/* File: asset_list.php
 * Desc: page to list all assets
 */
 session_start();
 if ($_SESSION['auth'] != "yes") {
    header("Location: login_form.php");
    exit();
}
include("dbconnector.inc");
    	$cxn = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
	$query =	"SELECT `Asset`.`AssetNo` AS 'Asset Number', 
			`Asset`.`Manufacturer`,
			`Asset`.`Model`,
			`Asset`.`Status`,
			`Asset`.`Location`,
			`Asset`.`LastAudit` AS 'Last Audit Date',
			`Asset`.`Type`,
			`Asset`.`DisposalDate` AS 'Disposal Date',
			`Asset`.`DisposalReason` AS 'Disposal Reason',
			`Asset`.`LoanDate` AS 'Loan Date',
			`Asset`.`LoanReason` AS 'Loan Reason',
			`Asset`.`ReturnDate` AS 'Return Date',
			`Asset`.`Comments`, 
			`Employee`.`EmployeeName` AS 'Assigned To' 
			FROM `Asset` 
			LEFT JOIN `AssetEmployee` ON `Asset`.`AssetNo`= `AssetEmployee`.`AssetNo` 
			LEFT JOIN `Employee` ON `AssetEmployee`.`EmployeeID` = `Employee`.`EmployeID`";
    	$result = mysqli_query($cxn, $query) or die("Couldn't execute query");

echo "<table>";
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
echo "<td>".$row['Assigned To']."</td>";
if($_SESSION['AccessLevel']== "IT"){
echo "<td><a href=index.php>Edit</a></td>";
}
echo "</tr>";
}
echo "</table>"; 
?>
</body></html>
