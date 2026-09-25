<?php
/**
 * save.php — Insert a New Student
 *
 * Receives the registration form from register.php, inserts the
 * student into the database, then shows a success or error message.
 *
 * This page is never visited directly — it's only reached by
 * submitting the form on register.php.
 */

// ---- Connect to the database ----------------------------------------
require 'db.php';

// ---- Handle the submitted form --------------------------------------
// Only run the insert if the request is actually a POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect and trim each field from the form.
    $admission_no = trim($_POST['admission_no']);
    $full_name    = trim($_POST['full_name']);
    $gender       = trim($_POST['gender']);
    $course       = trim($_POST['course']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);

    // Prepared statement — safely inserts the values.
    // "ssssss" means all six values are strings.
    $stmt = $conn->prepare(
        "INSERT INTO students (admission_no, full_name, gender, course, email, phone)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssss", $admission_no, $full_name, $gender, $course, $email, $phone);

    // Execute and remember whether it worked.
    $success = $stmt->execute();

    // Clean up.
    $stmt->close();
    $conn->close();
} else {
    // Someone opened save.php directly (not via the form).
    $success = false;
}

// ---- Render the confirmation page -----------------------------------
$pageTitle = "Save Student";
include 'includes/header.php';
?>

<main>
    <?php if ($success): ?>
    <div class="message success">Student record saved successfully!</div>
    <?php else: ?>
    <div class="message error">Failed to save student record. Please try again.</div>
    <?php endif; ?>

    <div class="buttons" style="margin-top:20px;">
        <a href="students.php" class="btn">View Students</a>
        <a href="register.php" class="btn btn-secondary">Register Another</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>