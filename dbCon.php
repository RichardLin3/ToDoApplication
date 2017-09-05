<?php

$dbhost="localhost";
$dbuser = "root";
$dbpass = "";
$dberror = "could not connect to the db";
$dbname = "todoapp";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname) or die($dberror);

?>
