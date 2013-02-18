<?php

/* File: contact_search_layout.inc
 * Desc: form layout for contact search
 */
 session_start();
?> 
<html>
<head>
<title>Contact Search Page</title>
<?php require('navigation.inc');?>
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>
<div id="leftmenu">

<?php sidebar();?>

</div>
<?php
if (isset($message)) {
	echo $message;
}
echo "<div id='mainbody'>";
echo "<h1>Contact Search</h1>";
echo "</br>";
echo "<form action ='$_SERVER[PHP_SELF]' method='POST'>
	<p><label for='contact_search' style='font-weight: bold; padding-bottom:1em'>Contact Search: </label>
		<input type='text' name='contact_search' id='contact_search' value='$contact_search'/></p></br>
	<p><input type='submit' value='Search'></p>
        <input type='hidden' name='searchfor' value='yes' />
</form>";
?>
</div>
</body>
</html>
