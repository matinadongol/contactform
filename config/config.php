<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'contactform');
define('DB_PASSWORD', '');

define('SITE_URL', 'http://localhost/contactform/');

$conn= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('database connection failed.');
mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

mysqli_query($conn, "SET NAMES utf8"); //unicode characters are saved as same in database
?>