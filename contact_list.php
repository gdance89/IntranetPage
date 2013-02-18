<?php
/* File: contact_list.php
 * Desc: Display all contacts
 */
 session_start();
?>
<html><head><title>Contact List Page</title></head>
<body>
<h1>Contact List Page</h1>
<?php
include("dbconnector.inc");
    $cxn = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
	$query = 	"SELECT `Employee`.`EmployeeName` AS 'Name', 
				`Employee`.`Office`, 
				`Employee`.`JobTitle` AS 'Job Title', 
				`Employee`.`PhoneNo` AS 'Phone Number', 
				`Employee`.`MobileNo` AS 'Mobile Number', 
				`Employee`.`Email`, 
				`Asset`.`AssetNo` AS 'Asset Number'
				FROM `Employee`
				LEFT JOIN `AssetEmployee` ON `Employee`.`EmployeID`=`AssetEmployee`.`EmployeeID`
				LEFT JOIN `Asset` ON `AssetEmployee`.`AssetNo`=`Asset`.`AssetNo`";
    $result = mysqli_query($cxn, $query) or die("Couldn't execute query");

	#echo"<h3>{$_SESSION['AccessLevel']}</h3>";
echo "<table>";

while($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>".$row['Name']."</td>";
echo "<td>".$row['Office']."</td>";
echo "<td>".$row['Job Title']."</td>";
echo "<td>".$row['Phone Number']."</td>";
echo "<td>".$row['Mobile Number']."</td>";
echo "<td>".$row['Email']."</td>";
if($_SESSION['AccessLevel']== "IT"){
echo "<td>".$row['Asset Number']."</td>";
#echo "<td><a href=index.php>Edit</a></td>";
}
echo "</tr>";
}   
echo "</table>"; 
?>
</body></html>
