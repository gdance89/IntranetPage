<?php

/*
 * File: login_form.php
 * Desc: Form to process user login
 */
session_start();
if (isset($_POST['sent']) && $_POST['sent'] == "yes") {
    foreach ($_POST as $field => $value) {
        if ($value == "") {
            $blank_array[$field] = $value;
        } else {
            $good_data[$field] = strip_tags(trim($value));
        }
    } //end foreach look
    if (@sizeof($blank_array) > 0) {
        $message = "<p style='color: red; margin-bottom: 0; font-weight: bold;'>
            You must enter both a username and a password.</p>";
        extract($blank_array);
        extract($good_data);
        include("login_form_layout.inc");
        exit();
    } //end if blanks found
    include("dbconnector.inc");
    $cxn = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
    $query = "SELECT EmployeeName, AccessLevel FROM Employee
                    WHERE Email='$_POST[user_name]'
                    AND Password='$_POST[password]'";
    $result = mysqli_query($cxn, $query) or die("Couldn't execute query");
    $n_row = mysqli_num_rows($result);
    if ($n_row < 1) {
        $message = "<p style='color: red; margin-bottom: 0; font-weight: bold'>
            User ID and Password not found.</p>";
        $extract($_POST);
        include("login_form_layout.inc");
        exit();
    } 
	else {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['EmployeeName'] = $row['EmployeeName'];
    $_SESSION['auth'] = "yes";
	$_SESSION['AccessLevel'] = $row['AccessLevel'];
    header("Location: secret_page.php");
    }
}
 else {
 $user_name = "";
 $password = "";
 include("login_form_layout.inc");
}
?>
