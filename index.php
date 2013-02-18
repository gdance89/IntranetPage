<?php
/* File: index.php
 * Desc: Home page for PRCO303
 */
 session_start();
?>

<html>
<head>
<title>PRCO303 Home Page</title>
<?php require('navigation.inc');?>
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>

<div id="leftmenu">

<p>Site Navigation</p>

<?php sidebar();?>

</div>

<div id="mainbody">

<h1>PRCO303 Home Page</h1>

</div>

</body></html>
