<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
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

        <footer>
            &copy; <?php echo date("Y"); ?>
            Springfield College of Technology. All rights reserved.
        </footer>
    </div>
</body>

</html>