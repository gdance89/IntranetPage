<?php
/* File: maintainence.php
 * Desc: page for maintainence of the system
 */
 session_start();
 if ($_SESSION['AccessLevel'] != "IT") {
    echo "<h1>You are not permitted in this area!</h1>";
    echo "<a href=index.php>Back to Home Page</a>";
	exit();
}
?>
<html>
<head>
<title>Maintainence Page</title>
</head>
<body>
<h1>Maintainence Page</h1>
</body>
</html>