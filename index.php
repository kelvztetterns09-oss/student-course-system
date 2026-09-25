<?php
/**
 * index.php — Home Page
 *
 * The landing page of the Student Course System. Shows a short
 * welcome message and two buttons: one to register a new student,
 * one to view the existing records.
 *
 * No database access is needed here — the page is purely static.
 */

// ---- Set the page title and pull in the shared top ------------------
$pageTitle = "Home - Student Course System";
include 'includes/header.php';
?>

<main>
    <section class="welcome">
        <h2>Welcome!</h2>
        <p>
            Manage student course registrations easily. Register new students,
            view all registered students, and update or delete records.
        </p>
        <div class="buttons">
            <a href="register.php" class="btn">Register Student</a>
            <a href="students.php" class="btn btn-secondary">View Students</a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>