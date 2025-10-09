-- Role-Based Access Control Setup
-- Run these commands in phpMyAdmin SQL tab

-- Step 1: Add role column to students table
ALTER TABLE students ADD COLUMN role ENUM('admin', 'student') DEFAULT 'student' AFTER email;

-- Step 2: Update existing users to have 'student' role
UPDATE students SET role = 'student' WHERE role IS NULL;

-- Step 3: Create admin account (password: admin123)
INSERT INTO students (first_name, last_name, email, password, role) 
VALUES ('Admin', 'User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE role = 'admin';

-- Step 4: Verify the setup
SELECT id, first_name, last_name, email, role FROM students;
