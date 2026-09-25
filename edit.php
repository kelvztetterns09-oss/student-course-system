<?php
require 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    header("Location: students.php");
    exit;
}

$student = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
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
            <h2>Edit Student</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id"
                    value="<?php echo $student['id']; ?>">

                <div class="form-group">
                    <label for="admission_no">Admission Number</label>
                    <input type="text" id="admission_no" name="admission_no"
                        value="<?php echo htmlspecialchars($student['admission_no']); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name"
                        value="<?php echo htmlspecialchars($student['full_name']); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <?php $g = $student['gender']; ?>
                        <label><input type="radio" name="gender" value="Male"
                                <?php echo $g === 'Male' ? 'checked' : ''; ?>
                            required> Male</label>
                        <label><input type="radio" name="gender" value="Female"
                                <?php echo $g === 'Female' ? 'checked' : ''; ?>>
                            Female</label>
                        <label><input type="radio" name="gender" value="Other"
                                <?php echo $g === 'Other' ? 'checked' : ''; ?>>
                            Other</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <?php
                        $courses = ["Computer Science", "Information Technology",
                                    "Business Administration", "Electrical Engineering",
                                    "Mechanical Engineering"];
$current = $student['course'];
?>
                    <select id="course" name="course" required>
                        <option value="">-- Select Course --</option>
                        <?php foreach ($courses as $c): ?>
                        <option value="<?php echo $c; ?>" <?php echo $current === $c ? 'selected' : ''; ?>>
                            <?php echo $c; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo htmlspecialchars($student['email']); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($student['phone']); ?>"
                        required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Update Student</button>
                    <a href="students.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </main>

        <footer>
            &copy; <?php echo date("Y"); ?>
            Springfield College of Technology. All rights reserved.
        </footer>
    </div>
</body>

</html>