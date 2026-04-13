<?php
/**
 * MUTCU Database Setup Script
 * Reliable database initialization with explicit SQL statements
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'mutcu_membership';

// Define all SQL statements
$statements = [
        // LOOKUP TABLES
        "CREATE TABLE `membership_types` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(50) NOT NULL UNIQUE,
            `description` TEXT,
            `can_vote` BOOLEAN DEFAULT FALSE,
            `can_nominate` BOOLEAN DEFAULT FALSE,
            `can_lead_union` BOOLEAN DEFAULT FALSE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        "CREATE TABLE `member_status` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `status_name` VARCHAR(50) NOT NULL UNIQUE,
            `description` TEXT,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        "CREATE TABLE `year_of_study` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `year_code` VARCHAR(20) NOT NULL UNIQUE,
            `description` VARCHAR(100),
            `display_name` VARCHAR(50),
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // USERS TABLE
        "CREATE TABLE `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `first_name` VARCHAR(100) NOT NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `phone` VARCHAR(20),
            `registration_number` VARCHAR(50) NOT NULL UNIQUE,
            `course_of_study` VARCHAR(200),
            `year_of_study_id` INT NOT NULL,
            `password_hash` VARCHAR(255) NOT NULL,
            `avatar_url` TEXT,
            `gender` ENUM('Male', 'Female', 'Prefer Not to Say'),
            `membership_type_id` INT NOT NULL DEFAULT 1,
            `member_status_id` INT NOT NULL DEFAULT 2,
            `is_active` BOOLEAN DEFAULT TRUE,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_users_year_of_study` FOREIGN KEY (`year_of_study_id`) REFERENCES `year_of_study`(`id`),
            CONSTRAINT `fk_users_membership_type` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_types`(`id`),
            CONSTRAINT `fk_users_member_status` FOREIGN KEY (`member_status_id`) REFERENCES `member_status`(`id`),
            INDEX `idx_registration_number` (`registration_number`),
            INDEX `idx_email` (`email`),
            INDEX `idx_member_status` (`member_status_id`),
            INDEX `idx_year_of_study` (`year_of_study_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // MINISTRIES TABLE
        "CREATE TABLE `ministries` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL UNIQUE,
            `description` TEXT,
            `coordinator_user_id` INT,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_ministries_coordinator` FOREIGN KEY (`coordinator_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
            INDEX `idx_ministry_name` (`name`),
            INDEX `idx_is_active` (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // LEADERSHIP ROLES TABLE
        "CREATE TABLE `leadership_roles` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `role_code` VARCHAR(50) NOT NULL UNIQUE,
            `role_name` VARCHAR(100) NOT NULL,
            `description` TEXT,
            `role_type` ENUM('Executive Council', 'Ministry Coordinator', 'Committee Coordinator', 'Sub-Ministry Leader', 'General Member') NOT NULL,
            `authority_level` INT DEFAULT 1,
            `ministry_id` INT,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_roles_ministry` FOREIGN KEY (`ministry_id`) REFERENCES `ministries`(`id`) ON DELETE SET NULL,
            INDEX `idx_role_type` (`role_type`),
            INDEX `idx_authority_level` (`authority_level`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // USER-MINISTRY-ROLE JUNCTION TABLE
        "CREATE TABLE `user_ministry_roles` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `ministry_id` INT NOT NULL,
            `leadership_role_id` INT NOT NULL,
            `is_primary_ministry` BOOLEAN DEFAULT FALSE,
            `assigned_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `start_date` DATE,
            `end_date` DATE,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_umr_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_umr_ministry` FOREIGN KEY (`ministry_id`) REFERENCES `ministries`(`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_umr_leadership_role` FOREIGN KEY (`leadership_role_id`) REFERENCES `leadership_roles`(`id`) ON DELETE RESTRICT,
            INDEX `idx_user_id` (`user_id`),
            INDEX `idx_ministry_id` (`ministry_id`),
            INDEX `idx_leadership_role_id` (`leadership_role_id`),
            INDEX `idx_is_active` (`is_active`),
            INDEX `idx_is_primary` (`is_primary_ministry`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // COMMITTEES TABLE
        "CREATE TABLE `committees` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL UNIQUE,
            `code` VARCHAR(50) NOT NULL UNIQUE,
            `description` TEXT,
            `committee_type` ENUM('Advisory Board', 'Auditing Committee', 'Resource Mobilization', 'Associates Committee', 'Interim Executive Council', 'Nomination College') NOT NULL,
            `chairperson_user_id` INT,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_committees_chairperson` FOREIGN KEY (`chairperson_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
            INDEX `idx_committee_type` (`committee_type`),
            INDEX `idx_is_active` (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // USER-COMMITTEE-ROLE JUNCTION TABLE
        "CREATE TABLE `user_committee_roles` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `committee_id` INT NOT NULL,
            `role_name` VARCHAR(100),
            `assigned_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `start_date` DATE,
            `end_date` DATE,
            `is_active` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_ucr_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            CONSTRAINT `fk_ucr_committee` FOREIGN KEY (`committee_id`) REFERENCES `committees`(`id`) ON DELETE CASCADE,
            INDEX `idx_user_id` (`user_id`),
            INDEX `idx_committee_id` (`committee_id`),
            INDEX `idx_is_active` (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // SYSTEM CONTENT TABLE
        "CREATE TABLE `system_content` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `content_key` VARCHAR(100) NOT NULL UNIQUE,
            `content_title` VARCHAR(200),
            `content_text` LONGTEXT NOT NULL,
            `last_edited_by_user_id` INT,
            `is_published` BOOLEAN DEFAULT TRUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT `fk_content_editor` FOREIGN KEY (`last_edited_by_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
            INDEX `idx_content_key` (`content_key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // AUDIT LOG TABLE
        "CREATE TABLE `audit_logs` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `action_type` VARCHAR(50) NOT NULL,
            `entity_type` VARCHAR(50),
            `entity_id` INT,
            `performed_by_user_id` INT,
            `details` JSON,
            `action_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX `idx_action_type` (`action_type`),
            INDEX `idx_entity_type` (`entity_type`),
            INDEX `idx_performed_by` (`performed_by_user_id`),
            INDEX `idx_action_date` (`action_date`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // SEED DATA
        "INSERT INTO `membership_types` (`name`, `description`, `can_vote`, `can_nominate`, `can_lead_union`) VALUES ('Full', 'Full member - Registered student', TRUE, TRUE, TRUE)",
        "INSERT INTO `membership_types` (`name`, `description`, `can_vote`, `can_nominate`, `can_lead_union`) VALUES ('Special', 'Special member - Postgraduate/ODL student', TRUE, FALSE, FALSE)",
        "INSERT INTO `membership_types` (`name`, `description`, `can_vote`, `can_nominate`, `can_lead_union`) VALUES ('Associate', 'Associate member - Alumni', FALSE, FALSE, FALSE)",
        
        "INSERT INTO `member_status` (`status_name`, `description`) VALUES ('Active', 'Active member in good standing')",
        "INSERT INTO `member_status` (`status_name`, `description`) VALUES ('Pending', 'Registration pending administrator approval')",
        "INSERT INTO `member_status` (`status_name`, `description`) VALUES ('Inactive', 'Inactive member')",
        "INSERT INTO `member_status` (`status_name`, `description`) VALUES ('Alumni', 'Graduated alumni member')",
        
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('1', 'First year - Anza FYT intake', 'Year 1 (Anza FYT)')",
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('2', 'Second year - Endelea 1', 'Year 2 (Endelea 1)')",
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('3', 'Third year - Endelea 2', 'Year 3 (Endelea 2)')",
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('4', 'Fourth year - Vuka FiT', 'Year 4 (Vuka FiT)')",
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('5', 'Fifth year - Vuka FiT', 'Year 5 (Vuka FiT)')",
        "INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES ('Alumni', 'Alumni / Associate member', 'Alumni')",
        
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Treasury Committee', 'Manages financial integrity, accountability, and proper fund management', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Hospitality Committee', 'Creates welcoming environment and manages office resources', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Music Committee', 'Leads worship through authentic, biblical, and excellent music', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Prayer Committee', 'Mobilizes and leads consistent, fervent, and effective prayer', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Missions and Evangelism Committee', 'Equips and mobilizes gospel proclamation on and off campus', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Bible Study & Training Committee', 'Facilitates systematic spiritual growth through God\\'s Word', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Discipleship Committee', 'Guides members at every stage of spiritual faith journey', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Creative Arts Ministry Committee', 'Uses diverse artistic gifts to glorify God and communicate gospel', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Technical & Media Ministry Committee', 'Provides excellent technical and media support for activities', TRUE)",
        "INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES ('Welfare Committee', 'Demonstrates Christ\\'s love through practical and spiritual support', TRUE)",
];

$success = 0;
$error = 0;
$setup_done = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to MySQL
        $pdo = new PDO("mysql:host=$db_host", $db_user, $db_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        // Drop and recreate database
        $pdo->exec("DROP DATABASE IF EXISTS `$db_name`");
        $pdo->exec("CREATE DATABASE `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Reconnect to the new database
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        // Execute all statements
        foreach ($statements as $stmt) {
            try {
                $pdo->exec($stmt);
                $success++;
            } catch (PDOException $e) {
                $error++;
            }
        }
        $setup_done = true;
        
    } catch (PDOException $e) {
        $error = 1;
        $setup_done = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUTCU Database Setup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #04003d; margin-bottom: 10px; }
        .status { padding: 15px; border-radius: 4px; margin: 20px 0; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .log { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; border-radius: 4px; max-height: 600px; overflow-y: auto; font-family: monospace; font-size: 12px; }
        .log-entry { padding: 4px 0; border-bottom: 1px solid #eee; }
        .log-entry.ok { color: green; }
        .log-entry.error { color: red; }
        button { background: #04003d; color: white; border: none; padding: 12px 24px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: 600; }
        button:hover { background: #03002d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 MUTCU Database Setup</h1>
        
        <?php if ($setup_done): ?>
            <?php if ($error === 0): ?>
                <div class="status success">
                    ✅ <strong>Setup Successful!</strong><br>
                    Database initialized with <?php echo $success; ?> statements.
                </div>
                <div class="status info">
                    <strong>System is Ready!</strong><br>
                    Go to the application homepage to continue.
                </div>
            <?php else: ?>
                <div class="status error">
                    ⚠ Setup had <?php echo $error; ?> errors (<?php echo $success; ?> successful)
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="status info">
                This will initialize the MUTCU Digital Membership System database.
            </div>
            <form method="POST">
                <p><strong>⚠️ Warning:</strong> This will drop any existing database and recreate it.</p>
                <button type="submit">✓ Proceed with Database Setup</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
