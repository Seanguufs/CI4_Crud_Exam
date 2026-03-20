-- Add profile columns to users table
<<<<<<< HEAD
ALTER TABLE users
ADD COLUMN student_id VARCHAR(20) AFTER role,
ADD COLUMN course VARCHAR(100) AFTER student_id,
ADD COLUMN year_level TINYINT AFTER course,
ADD COLUMN section VARCHAR(50) AFTER year_level,
ADD COLUMN phone VARCHAR(20) AFTER section,
ADD COLUMN address TEXT AFTER phone,
ADD COLUMN profile_image VARCHAR(255) AFTER address;
=======
ALTER TABLE `users` 
ADD COLUMN `student_id` VARCHAR(20) NULL AFTER `role`,
ADD COLUMN `course` VARCHAR(100) NULL AFTER `student_id`,
ADD COLUMN `year_level` TINYINT NULL AFTER `course`,
ADD COLUMN `section` VARCHAR(50) NULL AFTER `year_level`,
ADD COLUMN `phone` VARCHAR(20) NULL AFTER `section`,
ADD COLUMN `address` TEXT NULL AFTER `phone`,
ADD COLUMN `profile_image` VARCHAR(255) NULL AFTER `address`;
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
