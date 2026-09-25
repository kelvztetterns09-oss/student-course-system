<?php
/**
 * delete.php — Delete a Student Record
 *
 * This page is triggered when the user clicks the "Delete" button on
 * students.php. It does NOT display anything — it just removes the
 * student from the database and immediately sends the user back to
 * the student list.
 *
 * Why no HTML here?
 *   Deletion is an "action" — there is nothing useful to show the user
 *   after a row is gone. Instead of rendering a page, we redirect them
 *   back to students.php so they can see the updated table.
 */

// ---- Connect to the database ----------------------------------------
// Pulls in db.php, which creates the $conn object we use below.
require 'db.php';

// ---- Get the student ID from the URL --------------------------------
// The Delete link on students.php looks like:  delete.php?id=5
// So $_GET['id'] holds the ID of the student to be deleted.
// We use intval() to force it into an integer — this blocks anyone
// from passing something malicious like "5 OR 1=1" through the URL.
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ---- Only proceed if we have a valid ID -----------------------------
// intval() returns 0 for anything invalid, so if $id is greater than 0
// we know we have a real number to work with.
if ($id > 0) {

    // Prepare the DELETE statement.
    // The "?" is a placeholder — this is called a prepared statement,
    // and it's the safe way to run SQL with user input. It prevents
    // SQL injection because MySQL treats the value as pure data,
    // never as part of the SQL command itself.
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");

    // Bind the actual integer value to the placeholder.
    // The "i" means the value is an integer.
    $stmt->bind_param("i", $id);

    // Run the deletion.
    $stmt->execute();

    // Close the prepared statement — always good practice
    // to free up resources as soon as we're done.
    $stmt->close();
}

// ---- Close the connection -------------------------------------------
$conn->close();

// ---- Send the user back to the student list -------------------------
// header() sets the raw HTTP response. "Location:" tells the browser
// to immediately navigate to students.php. Without exit, PHP would
// keep executing the rest of the file (there is none here, but it's
// a safety habit — always exit after a redirect).
header("Location: students.php");
exit;
?>