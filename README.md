# 🎓 Student Course System

A multi-page PHP + MySQL web application for managing student course registrations.
Register students, view records, edit details, and delete entries.

---

## Features

- Register students (admission number, name, gender, course, email, phone)
- View all registered students
- Edit and update existing records
- Delete students with confirmation
- Responsive emerald-themed UI

---

## Tech Stack

- PHP
- MySQL
- HTML & CSS
- XAMPP (Apache + MySQL)

---

## Setup

1. Clone the repo into your web root (`htdocs` for XAMPP).
2. Create the database and table:

   ```sql
   CREATE DATABASE student_course_db;

   USE student_course_db;

   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       admission_no VARCHAR(20) NOT NULL,
       full_name VARCHAR(100) NOT NULL,
       gender VARCHAR(10) NOT NULL,
       course VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       phone VARCHAR(20) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

3. Start Apache and MySQL.
4. Open `http://localhost/Student_Course_System/index.php` in your browser.

---

## Notes

- Default DB credentials assume XAMPP (`localhost`, user `root`, empty password). Change in `db.php` if needed.
