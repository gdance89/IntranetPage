<?php

/* File: asset_search_layout.inc
 * Desc: form layout for asset search
 */
 
echo "<html><head><title>Asset Search Page</title></head>";

if (isset($message)) {
	echo $message;
}

echo "<form action ='$_SERVER[PHP_SELF]' 
			method='POST' style='margin: .5in'>\n
	<p><label for='asset_search' style='font-weight: bold; padding-bottom:1em'>Asset Search: </label>
		<input type='text' name='asset_search' id='asset_search' value='$asset_search'/>\n</p>
	<p><input type='submit' value='Search'>\n</p>
        <input type='hidden' name='searchfor' value='yes' />
</form>\n";

?>
