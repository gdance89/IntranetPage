<?php
/* File: secret_page.php
 * Desc: displays a confirmation that a user logged in
 */
session_start();
if ($_SESSION['auth'] != "yes") {
    header("Location: login_form.php");
    exit();
}
echo "<html>
    <head><Title>Secret Page with a session</title></head>
    <body>";
	echo "<a href = logout.php>Log Out</a>";
	echo "<p style='text-align: center; margin: .5in'>
    Hello, {$_SESSION['EmployeeName']}<br /></p>";
	if($_SESSION['AccessLevel'] == "Manager") {
	echo "<p style='text-align: center; margin: .5in'>
        Welcome to the Manager Section</p>\n";
	}
	elseif ($_SESSION['AccessLevel'] == "HR") {
	echo "<p style='text-align: center; margin: .5in'>
        Welcome to the HR section</p>\n";
	}
	elseif ($_SESSION['AccessLevel'] == "IT") {
	echo "<p style='text-align: center; margin: .5in'>
        Welcome to the IT section</p>\n";	
	}
	else{ 
	echo "<p style='text-align: center; margin: .5in'>
    Hello, {$_SESSION['EmployeeName']}<br />
    Welcome to the secret page</p>\n";
	echo "<p style='text-align: center; margin: .5in'>
    Your access level is {$_SESSION['AccessLevel']}<br/></p>\n";
	}
	echo "<a href=index.php>Home Page</a>";
?>
</body></html>