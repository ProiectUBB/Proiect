<?php
$server = "localhost";
$user = "root";
$parola = "";
$db = "sql_catalog";

$conn = new mysqli($server,$user,$parola,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
