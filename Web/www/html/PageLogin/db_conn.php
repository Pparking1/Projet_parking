<?php

$sname= "localhost";
$unmae= "openalpr";
$password = "openalpr";
$db_name = "projet_parking";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection echouer!";
}