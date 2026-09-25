<?php
/**
 * edit.php — Edit an Existing Student
 *
 * Loads one student's details from the database and displays them
 * inside a form. When the user submits, the data goes to update.php.
 *
 * If the student ID doesn't exist, we redirect back to students.php.
 */

// ---- Connect to the database ----------------------------------------
require 'db.php';

// ---- Read the student ID from the URL -------------------------------
// The Edit link on students.php looks like:  edit.php?id=5
// intval() forces it into a safe integer.
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ---- Fetch that one student -----------------------------------------
// Prepared statement — safe against SQL injection.
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// ---- If no student found, send the user back to the list ------------
if ($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    header("Location: students.php");
    exit;
}

// ---- We have a student — grab the row and clean up ------------------
$student = $result->fetch_assoc();
$stmt->close();
$conn->close();

// ---- Now render the page --------------------------------------------
$pageTitle = "Edit Student";
include 'includes/header.php';
?>

<main>
    <h2>Edit Student</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

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

<?php include 'includes/footer.php'; ?>