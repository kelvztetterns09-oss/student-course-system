<?php
/**
 * header.php — Shared Page Top
 *
 * Prints the <head> and the site header (brand + nav).
 * Does NOT open <main> — that belongs to each page.
 *
 * Pages set $pageTitle before including this file.
 * The current filename is used to highlight the active nav link.
 */

$page = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? $pageTitle : 'Student Course System';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/favc.png">
</head>

<body>
    <div class="container">
        <header>
            <div class="brand">
                <h1>Springfield College of Technology</h1>
                <p>Student Course Registration System</p>
            </div>

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
        </header>