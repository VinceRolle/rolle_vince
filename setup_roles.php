<?php
/**
 * Setup script to add role-based access control
 * Run this script once to set up the database and create admin account
 */

echo "=== Role-Based Access Control Setup ===\n\n";

// Database configuration for XAMPP (adjust if needed)
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = '';

// Try to detect database name from environment or common XAMPP setups
if (empty($dbname)) {
    // Common XAMPP database names - you may need to change this
    $possible_dbs = ['render_rolle', 'rolle_vince', 'test', 'phpmyadmin'];
    
    echo "Attempting to detect database...\n";
    
    foreach ($possible_dbs as $db) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Check if students table exists
            $result = $pdo->query("SHOW TABLES LIKE 'students'");
            if ($result->rowCount() > 0) {
                $dbname = $db;
                echo "Found database: $db\n";
                break;
            }
        } catch (PDOException $e) {
            // Database doesn't exist or can't connect
            continue;
        }
    }
}

if (empty($dbname)) {
    echo "ERROR: Could not detect database automatically.\n";
    echo "Please manually run the SQL commands below in phpMyAdmin:\n\n";
    echo "=== MANUAL SETUP INSTRUCTIONS ===\n";
    echo "1. Open phpMyAdmin in your browser\n";
    echo "2. Select your database from the left sidebar\n";
    echo "3. Go to the SQL tab\n";
    echo "4. Copy and paste the following SQL commands:\n\n";
    echo "-- Add role column to students table\n";
    echo "ALTER TABLE students ADD COLUMN role ENUM('admin', 'student') DEFAULT 'student' AFTER email;\n\n";
    echo "-- Update existing users to have 'student' role\n";
    echo "UPDATE students SET role = 'student' WHERE role IS NULL;\n\n";
    echo "-- Create admin account (password: admin123)\n";
    echo "INSERT INTO students (first_name, last_name, email, password, role) \n";
    echo "VALUES ('Admin', 'User', 'admin@example.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')\n";
    echo "ON DUPLICATE KEY UPDATE role = 'admin';\n\n";
    echo "=== END MANUAL SETUP ===\n";
    exit;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database: $dbname\n";
    
    // Check if role column already exists
    $result = $pdo->query("SHOW COLUMNS FROM students LIKE 'role'");
    if ($result->rowCount() > 0) {
        echo "Role column already exists. Skipping table modification.\n";
    } else {
        // Add role column to students table
        $sql = "ALTER TABLE students ADD COLUMN role ENUM('admin', 'student') DEFAULT 'student' AFTER email";
        $pdo->exec($sql);
        echo "Added role column to students table.\n";
    }
    
    // Update existing users to have 'student' role if they don't have one
    $sql = "UPDATE students SET role = 'student' WHERE role IS NULL";
    $pdo->exec($sql);
    echo "Updated existing users to have 'student' role.\n";
    
    // Create admin account (password: admin123)
    $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $sql = "INSERT INTO students (first_name, last_name, email, password, role) 
            VALUES ('Admin', 'User', 'admin@example.com', :password, 'admin')
            ON DUPLICATE KEY UPDATE role = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':password', $adminPassword);
    $stmt->execute();
    echo "Created admin account (email: admin@example.com, password: admin123).\n";
    
    echo "\n=== Setup completed successfully! ===\n";
    echo "You can now login with:\n";
    echo "Admin: admin@example.com / admin123\n";
    echo "Regular students will have 'student' role by default.\n";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
    echo "\n=== MANUAL SETUP INSTRUCTIONS ===\n";
    echo "Please run the following SQL commands in phpMyAdmin:\n\n";
    echo "-- Add role column to students table\n";
    echo "ALTER TABLE students ADD COLUMN role ENUM('admin', 'student') DEFAULT 'student' AFTER email;\n\n";
    echo "-- Update existing users to have 'student' role\n";
    echo "UPDATE students SET role = 'student' WHERE role IS NULL;\n\n";
    echo "-- Create admin account (password: admin123)\n";
    echo "INSERT INTO students (first_name, last_name, email, password, role) \n";
    echo "VALUES ('Admin', 'User', 'admin@example.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')\n";
    echo "ON DUPLICATE KEY UPDATE role = 'admin';\n\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
