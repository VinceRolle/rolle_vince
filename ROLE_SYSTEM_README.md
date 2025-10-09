# Role-Based Access Control System

This system implements role-based access control with two user roles: **Admin** and **Student**.

## Features

### Admin Role
- ✅ Can view all students
- ✅ Can add new students
- ✅ Can edit existing students
- ✅ Can delete students
- ✅ Full access to all CRUD operations

### Student Role
- ✅ Can view all students (read-only)
- ❌ Cannot add new students
- ❌ Cannot edit students
- ❌ Cannot delete students
- ❌ Limited to view-only access

## Setup Instructions

1. **Run the database migration:**
   ```bash
   php setup_roles.php
   ```
   Or manually run the SQL commands in `add_role_migration.sql`

2. **Default Admin Account:**
   - Email: `admin@example.com`
   - Password: `admin123`

3. **User Registration:**
   - New users are automatically assigned the 'student' role
   - Only admins can create new student accounts through the interface

## How It Works

### Database Changes
- Added `role` column to the `students` table
- Role can be either 'admin' or 'student'
- Default role for new users is 'student'

### Authentication
- User role is stored in session after login
- Role is checked on each page load
- Unauthorized access redirects to login page

### Access Control
- Admin users see full interface with add/edit/delete buttons
- Student users see read-only interface
- Server-side validation prevents unauthorized actions

### Files Modified
- `app/controllers/AuthController.php` - Added role handling
- `app/controllers/StudentsController.php` - Added role-based access control
- `app/views/students/get_all.php` - Added role-based UI
- `app/helpers/role_helper.php` - New helper for role management

## Security Notes

- All role checks are performed server-side
- Client-side UI changes are for user experience only
- Database operations are protected by role validation
- Session management includes role information

## Testing

1. Login as admin (`admin@example.com` / `admin123`)
   - Should see "Add Student" button
   - Should see Edit/Delete buttons for each student
   - Should see "👑 ADMIN" badge

2. Register a new student account
   - Should see "👨‍🎓 STUDENT" badge
   - Should NOT see "Add Student" button
   - Should see "View Only" instead of Edit/Delete buttons

## Customization

To add more roles or modify permissions, update:
- Database ENUM values
- `role_helper.php` functions
- Controller access checks
- View conditional statements
