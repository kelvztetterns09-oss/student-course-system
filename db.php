<?php
/**
 * db.php — Database Connection File
 *
 * This file is responsible for ONE thing only: opening a connection
 * to the MySQL database and making it available to every page that
 * includes it.
 *
 * Why a separate file?
 *   Every page that needs to read from or write to the database would
 *   otherwise repeat the same connection code. By centralizing it here,
 *   we only ever change credentials or the database name in one place.
 *
 * How it's used in other pages:
 *   require 'db.php';       // pulls this file in, creates $conn
 *   $conn->query("...");    // now the page can run SQL queries
 *
 * Note: the connection is stored in the variable $conn, which becomes
 * available to whichever file included this one.
 */

// ---- Database credentials -------------------------------------------
// These are the default values for a standard XAMPP installation.
// Change them here if your MySQL setup uses different values.
$host     = "localhost";          // MySQL server runs on the same machine
$user     = "root";               // default XAMPP MySQL username
$password = "";                   // default XAMPP has no password
$database = "student_course_db";  // the database created for this project

// ---- Open the connection --------------------------------------------
// mysqli is PHP's built-in library for talking to MySQL.
// Passing the four values above creates a live connection object,
// which we store in $conn for later use.
$conn = new mysqli($host, $user, $password, $database);

// ---- Check if the connection worked ---------------------------------
// If anything went wrong (wrong credentials, MySQL not running,
// database missing), the connection will hold an error message.
// We stop execution immediately and show the reason, because nothing
// useful can happen without a working database connection.
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}