<?php
$server_name="localhost";$user="root";$password="12345";$dbname = "rest";
 $conn = new mysqli($server_name, $user, $password,$dbname); //Create connection to database
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

