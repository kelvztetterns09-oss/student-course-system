<?php
/**
 * register.php — Student Registration Form
 *
 * Displays a form for adding a new student. The form submits to
 * save.php, which handles the database insert and confirmation.
 *
 * No database access is needed on this page — it only renders HTML.
 */

// ---- Set the page title and pull in the shared top ------------------
$pageTitle = "Register Student";
include 'includes/header.php';
?>

<main>
    <h2>Student Registration Form</h2>
    <form action="save.php" method="POST">
        <div class="form-group">
            <label for="admission_no">Admission Number</label>
            <input type="text" id="admission_no" name="admission_no" required>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" required> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
                <label><input type="radio" name="gender" value="Other"> Other</label>
            </div>
        </div>

        <div class="form-group">
            <label for="course">Course</label>
            <select id="course" name="course" required>
                <option value="" disabled selected>-- Select Course --</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Business Administration">Business Administration</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</main>

<?php include 'includes/footer.php'; ?>