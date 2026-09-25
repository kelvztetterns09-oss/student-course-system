<?php
/**
 * update.php — Update an Existing Student
 *
 * Receives the edit form from edit.php, updates the matching row
 * in the database, then shows a success or error message.
 *
 * This page is never visited directly — it's only reached by
 * submitting the form on edit.php.
 */

// ---- Connect to the database ----------------------------------------
require 'db.php';

// ---- Handle the submitted form --------------------------------------
// Only run the update if the request is actually a POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect and clean each field from the form.
    $id           = intval($_POST['id']);          // must be an integer
    $admission_no = trim($_POST['admission_no']);
    $full_name    = trim($_POST['full_name']);
    $gender       = trim($_POST['gender']);
    $course       = trim($_POST['course']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);

    // Prepared UPDATE — safely writes the new values.
    // The placeholder order matches bind_param below.
    $stmt = $conn->prepare(
        "UPDATE students
         SET admission_no = ?, full_name = ?, gender = ?, course = ?, email = ?, phone = ?
         WHERE id = ?"
    );

    // "ssssssi" = six strings followed by one integer (the ID).
    $stmt->bind_param("ssssssi", $admission_no, $full_name, $gender, $course, $email, $phone, $id);

    // Run the update and remember whether it worked.
    $success = $stmt->execute();

    // Clean up.
    $stmt->close();
    $conn->close();
} else {
    // Someone opened update.php directly (not via the form).
    $success = false;
}

// ---- Render the confirmation page -----------------------------------
$pageTitle = "Update Student";
include 'includes/header.php';
?>

<main>
    <?php if ($success): ?>
    <div class="message success">Student record updated successfully!</div>
    <?php else: ?>
    <div class="message error">Failed to update student record.</div>
    <?php endif; ?>

    <div class="buttons" style="margin-top:20px;">
        <a href="students.php" class="btn">Back to Student List</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>