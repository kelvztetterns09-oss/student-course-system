<?php

// Database connection file
$host = "localhost";
$user = "root";
$password = "";
$database = "student_course_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
