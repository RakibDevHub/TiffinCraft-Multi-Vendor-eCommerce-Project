<?php
$username = "rakib";
$password = "4006";
$hostname = "localhost";
$port = "1521";
$service_name = "mypdb"; // Use your service name

// Oracle connection string format
$connection_string = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$hostname)(PORT=$port)))(CONNECT_DATA=(SERVICE_NAME=$service_name)))";

// Connect to Oracle
$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    $e = oci_error();
    echo "Connection failed: " . $e['message'];
} else {
    echo "Connected to Oracle database successfully!";
}
?>