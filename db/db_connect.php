<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost", "root", "", "4432_db");
 
// Check connection
if($mysqli === false){
    die("ERROR: Unable to connect to database. " . $mysqli->connect_error);
}
 
?>