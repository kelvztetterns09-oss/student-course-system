<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Student Course System</title>
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

        <footer>
            &copy; <?php echo date("Y"); ?>
            Springfield College of Technology. All rights reserved.
        </footer>
    </div>
</body>

</html>