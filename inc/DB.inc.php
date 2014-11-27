<?php

define ('DB_USER', 'root');
define ('DB_PASSWORD', 'root');
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'shiftsri_hc14qa');

$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
	or die('Could not connect to database');
mysql_select_db(DB_NAME)
	or die ('Could not select database');

// EOF.