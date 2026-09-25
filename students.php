<?php
/**
 * students.php — View All Registered Students
 *
 * Fetches every student from the database and displays them in a
 * responsive table. Each row has Edit and Delete action buttons.
 *
 * If there are no students, an empty-state message is shown instead.
 */

// ---- Connect and fetch all students (newest first) ------------------
require 'db.php';
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");

// ---- Render the page ------------------------------------------------
$pageTitle = "View Students";
include 'includes/header.php';
?>

<main>
    <h2>Registered Students</h2>

    <?php if ($result && $result->num_rows > 0): ?>
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
    <p class="empty">No students registered yet.</p>
    <div class="buttons" style="margin-top:20px;">
        <a href="register.php" class="btn">Register First Student</a>
    </div>
    <?php endif; ?>
</main>

<?php
include 'includes/footer.php';
$conn->close();
?>