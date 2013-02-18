<?php 
/* File: navigation.inc
 * Desc: navigation bar
 */
 function sidebar() {
 session_start();

if($_SESSION['auth'] != "yes") {
echo "<p><a href=login_form.php>Login</a></br>";
}
elseif($_SESSION['auth'] == "yes") {
echo "<p>Hello, {$_SESSION['EmployeeName']}</p><p><a href=logout.php>Logout</a></br></p>";
}
echo "<a href=contact_search.php>Contact Search</a></br>";
echo "<a href=contact_list.php>Contact List</a></br>";
if($_SESSION['AccessLevel'] == "Manager" 
or $_SESSION['AccessLevel'] == "HR" 
or $_SESSION['AccessLevel'] == "IT"){
echo "<a href=asset_search.php>Asset Search</a></br>";
echo "<a href=asset_list.php>Asset List</a></br>";
if($_SESSION['AccessLevel'] == "IT") {
echo "<a href=maintainence.php>Maintainence</a></br>";
}
}
}
?>