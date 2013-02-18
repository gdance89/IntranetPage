<?php

/* File: login_form.inc
 * Desc: Contains the code for a web page that displays a login form.
 */

echo "<head><title>PRCO303 Login Page</title></head>";

if (isset($message)) {
    echo $message;
}

echo "<form action='$_SERVER[PHP_SELF]'
            method='POST' style='margin: .5in'>\n 
    <p><label for='user_name' style='font-weight: bold; padding-bottom:1em'>User ID: </label>
        <input type='text' name='user_name' id='user_name' value='$user_name' />\n</p>
    <p><label for='password' style='font-weight: bold'>Password: </label>
        <input type='password' name='password' id='password' value='$password' />\n</p>
    <p><input type='submit' value='Log in'>\n</p>
        <input type='hidden' name='sent' value='yes' />
</form>\n";

?>