<?php
/**
 * students.php — View All Registered Students (with Search & Filter)
 *
 * Fetches students from the database and displays them in a table.
 * Supports optional filtering by:
 *   - search term (matches admission_no, full_name, or email)
 *   - course
 *   - gender
 *
 * Filters come from the URL via GET so they're shareable/bookmarkable.
 */

require 'db.php';

// ---- Read filters from the URL --------------------------------------
// If a filter isn't set, it defaults to an empty string.
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$course = isset($_GET['course']) ? trim($_GET['course']) : '';
$gender = isset($_GET['gender']) ? trim($_GET['gender']) : '';

// ---- Build the query dynamically ------------------------------------
// Start with a base SELECT, then append conditions only for the
// filters that were actually provided.
$sql    = "SELECT * FROM students";
$where  = [];
$params = [];
$types  = "";

// Search: match against three columns using LIKE
if ($search !== '') {
    $where[]  = "(admission_no LIKE ? OR full_name LIKE ? OR email LIKE ?)";
    $like     = "%" . $search . "%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types   .= "sss";
}

// Course: exact match
if ($course !== '') {
    $where[]  = "course = ?";
    $params[] = $course;
    $types   .= "s";
}

// Gender: exact match
if ($gender !== '') {
    $where[]  = "gender = ?";
    $params[] = $gender;
    $types   .= "s";
}

// Attach WHERE clause if any filters were applied
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY id DESC";

// ---- Prepare and run -------------------------------------------------
$stmt = $conn->prepare($sql);

// bind_param needs the values by reference — use the spread trick
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Count how many rows matched (for the feedback line)
$total = $result->num_rows;

// Courses list for the dropdown (mirror of register.php)
$courses = [
    "Computer Science",
    "Information Technology",
    "Business Administration",
    "Electrical Engineering",
    "Mechanical Engineering"
];

// ---- Render ---------------------------------------------------------
$pageTitle = "View Students";
include 'includes/header.php';
?>

<main>
    <h2>Registered Students</h2>

    <!-- Filter bar -->
    <form method="GET" action="students.php" class="filter-bar">
        <div class="form-group">
            <label for="search">Search</label>
            <input type="text" id="search" name="search" placeholder="Admission no, name, or email"
                value="<?php echo htmlspecialchars($search); ?>">
        </div>

        <div class="form-group">
            <label for="course">Course</label>
            <select id="course" name="course">
                <option value="">All Courses</option>
                <?php foreach ($courses as $c): ?>
                <option value="<?php echo $c; ?>" <?php echo $course === $c ? 'selected' : ''; ?>>
                    <?php echo $c; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="">All Genders</option>
                <option value="Male" <?php echo $gender === 'Male' ? 'selected' : ''; ?>>Male
                </option>
                <option value="Female" <?php echo $gender === 'Female' ? 'selected' : ''; ?>>Female
                </option>
                <option value="Other" <?php echo $gender === 'Other' ? 'selected' : ''; ?>>Other
                </option>
            </select>
        </div>

        <div class="actions-row">
            <button type="submit" class="btn">Filter</button>
            <a href="students.php" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <!-- Result count -->
    <?php if ($total > 0): ?>
    <p class="result-count">
        Showing <?php echo $total; ?>
        result<?php echo $total === 1 ? '' : 's'; ?>.
    </p>
    <?php endif; ?>

    <!-- Table or empty state -->
    <?php if ($total > 0): ?>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Admission No</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
        while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['admission_no']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['gender']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['course']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['email']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['phone']); ?>
                    </td>
                    <td><?php echo date("d M Y, H:i", strtotime($row['created_at'])); ?>
                    </td>
                    <td>
                        <div class="actions">
                            <a class="btn btn-edit"
                                href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-danger"
                                href="delete.php?id=<?php echo $row['id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="empty">
        <?php if ($search || $course || $gender): ?>
        No students match your filters.
        <?php else: ?>
        No students registered yet.
        <?php endif; ?>
    </p>
    <div class="buttons" style="margin-top:20px;">
        <?php if ($search || $course || $gender): ?>
        <a href="students.php" class="btn btn-secondary">Clear Filters</a>
        <?php else: ?>
        <a href="register.php" class="btn">Register First Student</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</main>

<?php
include 'includes/footer.php';
$conn->close();
?>