<?php
/**
 * save.php — Insert a New Student (with validation)
 *
 * Receives the registration form from register.php, validates every
 * field, and either:
 *   - Inserts the student and shows a success message, or
 *   - Stores the errors and old input in the session and sends the
 *     user back to register.php to fix them.
 */

session_start();
require 'db.php';

// Only process if the form was actually submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

// ---- Collect and trim the input -------------------------------------
$admission_no = trim($_POST['admission_no'] ?? '');
$full_name    = trim($_POST['full_name']    ?? '');
$gender       = trim($_POST['gender']       ?? '');
$course       = trim($_POST['course']       ?? '');
$email        = trim($_POST['email']        ?? '');
$phone        = trim($_POST['phone']        ?? '');

// ---- Validate -------------------------------------------------------
$errors = [];

// Admission number: required
if ($admission_no === '') {
    $errors['admission_no'] = "Admission number is required.";
}

// Full name: required, at least 2 characters
if ($full_name === '') {
    $errors['full_name'] = "Full name is required.";
} elseif (mb_strlen($full_name) < 2) {
    $errors['full_name'] = "Full name must be at least 2 characters.";
}

// Gender: must be one of the allowed values
$allowed_genders = ['Male', 'Female', 'Other'];
if (!in_array($gender, $allowed_genders, true)) {
    $errors['gender'] = "Please select a gender.";
}

// Course: must be one of the allowed values
$allowed_courses = [
    'Computer Science',
    'Information Technology',
    'Business Administration',
    'Electrical Engineering',
    'Mechanical Engineering',
];
if (!in_array($course, $allowed_courses, true)) {
    $errors['course'] = "Please select a valid course.";
}

// Email: required, valid format
if ($email === '') {
    $errors['email'] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address (e.g. name@example.com).";
}

// Phone: required, sensible length, allowed characters only
if ($phone === '') {
    $errors['phone'] = "Phone number is required.";
} elseif (!preg_match('/^[0-9+\-\s]{7,15}$/', $phone)) {
    $errors['phone'] = "Phone must be 7–15 digits (spaces, +, - allowed).";
}

// ---- If anything failed, bounce back to the form --------------------
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = [
        'admission_no' => $admission_no,
        'full_name'    => $full_name,
        'gender'       => $gender,
        'course'       => $course,
        'email'        => $email,
        'phone'        => $phone,
    ];

    header("Location: register.php");
    exit;
}

// ---- All good — insert ----------------------------------------------
$stmt = $conn->prepare(
    "INSERT INTO students (admission_no, full_name, gender, course, email, phone)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssss", $admission_no, $full_name, $gender, $course, $email, $phone);
$success = $stmt->execute();
$stmt->close();
$conn->close();

// ---- Show confirmation ----------------------------------------------
$pageTitle = "Save Student";
include 'includes/header.php';
?>

<main>
    <div class="message success">Student record saved successfully!</div>

    <div class="buttons" style="margin-top:20px;">
        <a href="students.php" class="btn">View Students</a>
        <a href="register.php" class="btn btn-secondary">Register Another</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>