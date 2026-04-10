-- ============================================
-- MUTCU DIGITAL MEMBERSHIP SYSTEM
-- DATABASE SCHEMA (MySQL 8.0+)
-- ============================================

-- Create Database
CREATE DATABASE IF NOT EXISTS `mutcu_membership`;
USE `mutcu_membership`;

-- ============================================
-- LOOKUP TABLES (Reference Data)
-- ============================================

CREATE TABLE IF NOT EXISTS `membership_types` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `description` TEXT,
    `can_vote` BOOLEAN DEFAULT FALSE,
    `can_nominate` BOOLEAN DEFAULT FALSE,
    `can_lead_union` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `member_status` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `status_name` VARCHAR(50) NOT NULL UNIQUE,
    `description` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `year_of_study` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `year_code` VARCHAR(20) NOT NULL UNIQUE,
    `description` VARCHAR(100),
    `display_name` VARCHAR(50),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- CORE USERS TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Personal Information
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `phone` VARCHAR(20),
    
    -- Academic Information
    `registration_number` VARCHAR(50) NOT NULL UNIQUE,
    `course_of_study` VARCHAR(200),
    `year_of_study_id` INT NOT NULL,
    
    -- Authentication
    `password_hash` VARCHAR(255) NOT NULL,
    
    -- Profile
    `avatar_url` TEXT,
    `gender` ENUM('Male', 'Female', 'Prefer Not to Say'),
    
    -- Membership
    `membership_type_id` INT NOT NULL DEFAULT 1,
    `member_status_id` INT NOT NULL DEFAULT 2,
    
    -- System Flags
    `is_active` BOOLEAN DEFAULT TRUE,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    CONSTRAINT `fk_users_year_of_study` FOREIGN KEY (`year_of_study_id`) REFERENCES `year_of_study`(`id`),
    CONSTRAINT `fk_users_membership_type` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_types`(`id`),
    CONSTRAINT `fk_users_member_status` FOREIGN KEY (`member_status_id`) REFERENCES `member_status`(`id`),
    
    -- Indexes for fast lookups
    INDEX `idx_registration_number` (`registration_number`),
    INDEX `idx_email` (`email`),
    INDEX `idx_member_status` (`member_status_id`),
    INDEX `idx_year_of_study` (`year_of_study_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- MINISTRIES TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS `ministries` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    
    -- Leadership Reference
    `coordinator_user_id` INT,
    
    -- Status
    `is_active` BOOLEAN DEFAULT TRUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_ministries_coordinator` FOREIGN KEY (`coordinator_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    
    INDEX `idx_ministry_name` (`name`),
    INDEX `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- LEADERSHIP ROLES TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS `leadership_roles` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `role_code` VARCHAR(50) NOT NULL UNIQUE,
    `role_name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    
    -- Role Type
    `role_type` ENUM('Executive Council', 'Ministry Coordinator', 'Committee Coordinator', 'Sub-Ministry Leader', 'General Member') NOT NULL,
    
    -- Authority Level (for cascading permissions)
    `authority_level` INT DEFAULT 1,
    
    -- Associated Ministry (if applicable)
    `ministry_id` INT,
    
    -- Status
    `is_active` BOOLEAN DEFAULT TRUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_roles_ministry` FOREIGN KEY (`ministry_id`) REFERENCES `ministries`(`id`) ON DELETE SET NULL,
    
    INDEX `idx_role_type` (`role_type`),
    INDEX `idx_authority_level` (`authority_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- USER-MINISTRY-ROLE JUNCTION TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS `user_ministry_roles` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- User and Ministry/Role relationship
    `user_id` INT NOT NULL,
    `ministry_id` INT NOT NULL,
    `leadership_role_id` INT NOT NULL,
    
    -- Primary Ministry flag
    `is_primary_ministry` BOOLEAN DEFAULT FALSE,
    
    -- Tenure
    `assigned_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `start_date` DATE,
    `end_date` DATE,
    
    -- Status
    `is_active` BOOLEAN DEFAULT TRUE,
    
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    CONSTRAINT `fk_umr_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_umr_ministry` FOREIGN KEY (`ministry_id`) REFERENCES `ministries`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_umr_leadership_role` FOREIGN KEY (`leadership_role_id`) REFERENCES `leadership_roles`(`id`) ON DELETE RESTRICT,
    
    -- Indexes
    INDEX `idx_user_id` (`user_id`),
    INDEX `idx_ministry_id` (`ministry_id`),
    INDEX `idx_leadership_role_id` (`leadership_role_id`),
    INDEX `idx_is_active` (`is_active`),
    INDEX `idx_is_primary` (`is_primary_ministry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- COMMITTEES TABLE (Special Committees)
-- ============================================

CREATE TABLE IF NOT EXISTS `committees` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Committee Info
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `description` TEXT,
    
    -- Committee Type (per Constitution Art 13)
    `committee_type` ENUM('Advisory Board', 'Auditing Committee', 'Resource Mobilization', 'Associates Committee', 'Interim Executive Council', 'Nomination College') NOT NULL,
    
    -- Leadership
    `chairperson_user_id` INT,
    
    -- Status
    `is_active` BOOLEAN DEFAULT TRUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_committees_chairperson` FOREIGN KEY (`chairperson_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    
    INDEX `idx_committee_type` (`committee_type`),
    INDEX `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- USER-COMMITTEE-ROLE JUNCTION TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS `user_committee_roles` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- User and Committee relationship
    `user_id` INT NOT NULL,
    `committee_id` INT NOT NULL,
    `role_name` VARCHAR(100),
    
    -- Tenure
    `assigned_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `start_date` DATE,
    `end_date` DATE,
    
    -- Status
    `is_active` BOOLEAN DEFAULT TRUE,
    
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    CONSTRAINT `fk_ucr_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ucr_committee` FOREIGN KEY (`committee_id`) REFERENCES `committees`(`id`) ON DELETE CASCADE,
    
    -- Indexes
    INDEX `idx_user_id` (`user_id`),
    INDEX `idx_committee_id` (`committee_id`),
    INDEX `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- SYSTEM CONTENT TABLE (Admin CMS)
-- ============================================

CREATE TABLE IF NOT EXISTS `system_content` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Content Identifier
    `content_key` VARCHAR(100) NOT NULL UNIQUE,
    `content_title` VARCHAR(200),
    
    -- Content
    `content_text` LONGTEXT NOT NULL,
    
    -- Metadata
    `last_edited_by_user_id` INT,
    `is_published` BOOLEAN DEFAULT TRUE,
    
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_content_editor` FOREIGN KEY (`last_edited_by_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    
    INDEX `idx_content_key` (`content_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- AUDIT LOG TABLE (For Compliance & Traceability)
-- ============================================

CREATE TABLE IF NOT EXISTS `audit_logs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Action Details
    `action_type` VARCHAR(50) NOT NULL,
    `entity_type` VARCHAR(50),
    `entity_id` INT,
    
    -- Actor (who performed the action)
    `performed_by_user_id` INT,
    
    -- Changes (JSON for flexibility)
    `details` JSON,
    
    -- Timestamp
    `action_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX `idx_action_type` (`action_type`),
    INDEX `idx_entity_type` (`entity_type`),
    INDEX `idx_performed_by` (`performed_by_user_id`),
    INDEX `idx_action_date` (`action_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- INSERT SEED DATA
-- ============================================

INSERT INTO `membership_types` (`name`, `description`, `can_vote`, `can_nominate`, `can_lead_union`) VALUES
('Full', 'Full member - Registered student', TRUE, TRUE, TRUE),
('Special', 'Special member - Postgraduate/ODL student', TRUE, FALSE, FALSE),
('Associate', 'Associate member - Alumni', FALSE, FALSE, FALSE);

INSERT INTO `member_status` (`status_name`, `description`) VALUES
('Active', 'Active member in good standing'),
('Pending', 'Registration pending administrator approval'),
('Inactive', 'Inactive member'),
('Alumni', 'Graduated alumni member');

INSERT INTO `year_of_study` (`year_code`, `description`, `display_name`) VALUES
('1', 'First year - Anza FYT intake', 'Year 1 (Anza FYT)'),
('2', 'Second year - Endelea 1', 'Year 2 (Endelea 1)'),
('3', 'Third year - Endelea 2', 'Year 3 (Endelea 2)'),
('4', 'Fourth year - Vuka FiT', 'Year 4 (Vuka FiT)'),
('5', 'Fifth year - Vuka FiT', 'Year 5 (Vuka FiT)'),
('Alumni', 'Alumni / Associate member', 'Alumni');

INSERT INTO `ministries` (`name`, `description`, `is_active`) VALUES
('Treasury Committee', 'Manages financial integrity, accountability, and proper fund management', TRUE),
('Hospitality Committee', 'Creates welcoming environment and manages office resources', TRUE),
('Music Committee', 'Leads worship through authentic, biblical, and excellent music', TRUE),
('Prayer Committee', 'Mobilizes and leads consistent, fervent, and effective prayer', TRUE),
('Missions and Evangelism Committee', 'Equips and mobilizes gospel proclamation on and off campus', TRUE),
('Bible Study & Training Committee', 'Facilitates systematic spiritual growth through God\'s Word', TRUE),
('Discipleship Committee', 'Guides members at every stage of spiritual faith journey', TRUE),
('Creative Arts Ministry Committee', 'Uses diverse artistic gifts to glorify God and communicate gospel', TRUE),
('Technical & Media Ministry Committee', 'Provides excellent technical and media support for activities', TRUE),
('Welfare Committee', 'Demonstrates Christ\'s love through practical and spiritual support', TRUE);

INSERT INTO `leadership_roles` (`role_code`, `role_name`, `description`, `role_type`, `authority_level`, `ministry_id`) VALUES
('CHAIRPERSON', 'Chairperson', 'Principal executive leader of the Christian Union', 'Executive Council', 5, NULL),
('FIRST_VICE_CHAIR', '1st Vice Chairperson (Female)', 'Oversees Ladies Ministry and Hospitality; assists Chairperson', 'Executive Council', 4, NULL),
('SECOND_VICE_CHAIR', '2nd Vice Chairperson (Male)', 'Oversees Gents Ministry and Welfare; custodian of Leadership Manual', 'Executive Council', 4, NULL),
('SECRETARY', 'Secretary', 'Manages official correspondence and member registry', 'Executive Council', 4, NULL),
('VICE_SECRETARY', 'Vice Secretary', 'Assists Secretary; manages CU library', 'Executive Council', 3, NULL),
('TREASURER', 'Treasurer', 'Chief financial officer; manages all funds and assets', 'Executive Council', 4, NULL),
('PRAYER_COORDINATOR', 'Prayer Coordinator', 'Heads Prayer Committee; champions prayer culture', 'Ministry Coordinator', 3, 4),
('MUSIC_COORDINATOR', 'Music Coordinator', 'Oversees all music ministries and worship', 'Ministry Coordinator', 3, 3),
('MISSIONS_COORDINATOR', 'Missions & Evangelism Coordinator', 'Leads gospel proclamation and outreach', 'Ministry Coordinator', 3, 5),
('BIBLE_STUDY_COORDINATOR', 'Bible Study & Training Coordinator', 'Oversees systematic spiritual growth through Bible study', 'Ministry Coordinator', 3, 6),
('DISCIPLESHIP_COORDINATOR', 'Discipleship Coordinator', 'Guides member spiritual development', 'Ministry Coordinator', 3, 7),
('CREATIVE_ARTS_COORDINATOR', 'Creative Arts Ministry Coordinator', 'Provides artistic direction and oversight', 'Ministry Coordinator', 3, 8),
('TECHNICAL_MEDIA_COORDINATOR', 'Technical & Media Ministry Coordinator', 'Oversees technical excellence and digital presence', 'Ministry Coordinator', 3, 9),
('WELFARE_COORDINATOR', 'Welfare Coordinator', 'Leads compassionate support ministry', 'Ministry Coordinator', 3, 10),
('GENERAL_MEMBER', 'General Member', 'Standard membership with participation rights', 'General Member', 1, NULL);

INSERT INTO `committees` (`name`, `code`, `description`, `committee_type`, `is_active`) VALUES
('Advisory Board', 'ADVISORY_BOARD', 'Provides wisdom, counsel, and guidance to leadership', 'Advisory Board', TRUE),
('Auditing Committee', 'AUDITING_COMMITTEE', 'Audits finances, accounts, and ensures asset protection', 'Auditing Committee', TRUE),
('Resource Mobilization Committee', 'RESOURCE_MOBILIZATION', 'Plans and executes fundraising and resource generation', 'Resource Mobilization', TRUE),
('Associates Committee', 'ASSOCIATES_COMMITTEE', 'Maintains link with alumni community', 'Associates Committee', TRUE),
('Nomination College', 'NOMINATION_COLLEGE', 'Conducts leadership nominations and transitions', 'Nomination College', TRUE);

INSERT INTO `system_content` (`content_key`, `content_title`, `content_text`, `is_published`) VALUES
('constitution_awareness', 'Constitution & Awareness Notice', 'As a member of MUTCU, you are called to uphold our core values of Faith, Love, Hope, and Godliness. Please review Article 8 of the 2025 Constitution regarding membership rights and responsibilities. Let us remain accountable to one another as we serve.', TRUE),
('leadership_intro', 'Leadership Introduction', 'As mandated by the MUTCU Constitution (2025), the Executive Council provides spiritual oversight and strategic direction to the Christian Union. They are here to serve, guide, and pray for the union.', TRUE);

-- ============================================
-- VIEWS
-- ============================================

CREATE OR REPLACE VIEW `v_executive_council` AS
SELECT 
    umr.user_id,
    u.first_name,
    u.last_name,
    u.email,
    lr.role_name,
    lr.role_code,
    m.name as ministry,
    umr.is_active
FROM user_ministry_roles umr
JOIN users u ON umr.user_id = u.id
JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
LEFT JOIN ministries m ON umr.ministry_id = m.id
WHERE lr.role_type = 'Executive Council' AND umr.is_active = TRUE;

CREATE OR REPLACE VIEW `v_active_members` AS
SELECT 
    u.id,
    u.first_name,
    u.last_name,
    u.registration_number,
    u.email,
    u.phone,
    mt.name as membership_type,
    ms.status_name,
    yos.display_name as year_of_study,
    u.course_of_study
FROM users u
JOIN membership_types mt ON u.membership_type_id = mt.id
JOIN member_status ms ON u.member_status_id = ms.id
JOIN year_of_study yos ON u.year_of_study_id = yos.id
WHERE ms.status_name = 'Active';

-- ============================================
-- END OF SCHEMA
-- ============================================
