<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admission_no = trim($_POST['admission_no']);
    $full_name    = trim($_POST['full_name']);
    $gender       = trim($_POST['gender']);
    $course       = trim($_POST['course']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);

    $stmt = $conn->prepare(
        "INSERT INTO students (admission_no, full_name, gender, course, email, phone)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssss", $admission_no, $full_name, $gender, $course, $email, $phone);

    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
} else {
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Save Student</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../Student_Course_System/images/favc.png">
</head>

<body>
    <div class="container">
        <header>
            <h1>Springfield College of Technology</h1>
            <p>Student Course Registration System</p>
        </header>

        <?php $page = basename($_SERVER['PHP_SELF']); ?>
        <nav>
            <a href="index.php"
                class="<?php echo $page === 'index.php' ? 'active' : ''; ?>">Home</a>
            <a href="register.php"
                class="<?php echo $page === 'register.php' ? 'active' : ''; ?>">Register
                Student</a>
            <a href="students.php"
                class="<?php echo $page === 'students.php' ? 'active' : ''; ?>">View
                Students</a>
        </nav>

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

        <footer>
            &copy; <?php echo date("Y"); ?>
            Springfield College of Technology. All rights reserved.
        </footer>
    </div>
</body>

</html>