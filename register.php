<?php
/**
 * register.php — Student Registration Form (with error display)
 *
 * Displays a form for adding a new student. If the user previously
 * submitted the form and had validation errors, those errors are
 * read from the session and displayed next to the relevant fields.
 *
 * The user's previous input is also restored so they don't have to
 * retype anything.
 */

session_start();

// ---- Pull errors and old input from the session ---------------------
// If nothing is stored, default to empty arrays.
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old']    ?? [];

// Clear them immediately — they're one-time use. If the user
// refreshes the page, the form should be empty again.
unset($_SESSION['errors'], $_SESSION['old']);

// ---- Helper: fetch a previously entered value -----------------------
// Returns the value from $old, or '' if it wasn't set.
function old(string $key, array $old)
{
    return $old[$key] ?? '';
}

// ---- Helper: fetch an error message for a field ---------------------
// Returns the message, or '' if there's no error for that field.
function err(string $key, array $errors)
{
    return $errors[$key] ?? '';
}

$pageTitle = "Register Student";
include 'includes/header.php';
?>

<main>
    <h2>Student Registration Form</h2>

    <?php if (!empty($errors)): ?>
    <div class="message error">
        Please fix the highlighted fields below and try again.
    </div>
    <?php endif; ?>

    <form action="save.php" method="POST">
        <div class="form-group">
            <label for="admission_no">Admission Number</label>
            <input type="text" id="admission_no" name="admission_no"
                value="<?php echo htmlspecialchars(old('admission_no', $old)); ?>"
                class="<?php echo err('admission_no', $errors) ? 'input-error' : ''; ?>"
                required>
            <?php if (err('admission_no', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('admission_no', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name"
                value="<?php echo htmlspecialchars(old('full_name', $old)); ?>"
                class="<?php echo err('full_name', $errors) ? 'input-error' : ''; ?>"
                required>
            <?php if (err('full_name', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('full_name', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="radio-group">
                <?php $g = old('gender', $old); ?>
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
            <?php if (err('gender', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('gender', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="course">Course</label>
            <?php
                $courses = [
                    "Computer Science",
                    "Information Technology",
                    "Business Administration",
                    "Electrical Engineering",
                    "Mechanical Engineering"
                ];
$selected = old('course', $old);
?>
            <select id="course" name="course"
                class="<?php echo err('course', $errors) ? 'input-error' : ''; ?>"
                required>
                <option value="" disabled <?php echo $selected === '' ? 'selected' : ''; ?>>--
                    Select Course --</option>
                <?php foreach ($courses as $c): ?>
                <option value="<?php echo $c; ?>" <?php echo $selected === $c ? 'selected' : ''; ?>>
                    <?php echo $c; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (err('course', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('course', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                value="<?php echo htmlspecialchars(old('email', $old)); ?>"
                class="<?php echo err('email', $errors) ? 'input-error' : ''; ?>"
                required>
            <?php if (err('email', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('email', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone"
                value="<?php echo htmlspecialchars(old('phone', $old)); ?>"
                class="<?php echo err('phone', $errors) ? 'input-error' : ''; ?>"
                required>
            <?php if (err('phone', $errors)): ?>
            <span
                class="field-error"><?php echo htmlspecialchars(err('phone', $errors)); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</main>

<?php include 'includes/footer.php'; ?>