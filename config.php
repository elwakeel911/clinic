<?php
$servername = "localhost";
$username = "root";
$password = ""; // لو انت مركب password لقاعدة البيانات حطه هنا
$dbname = "clinic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
