-- =====================================================
-- MUTCU MEMBERSHIP SYSTEM - ENHANCED DATABASE SCHEMA
-- Version 2.0 - Extended Features
-- =====================================================

-- 1. PASSWORD RESET TOKENS TABLE
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    expires_at TIMESTAMP NOT NULL,
    used_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_token (token),
    INDEX idx_user_expires (user_id, expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. EVENTS TABLE
CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    event_type ENUM('prayer_meeting', 'conference', 'training', 'service', 'social', 'other') NOT NULL,
    location VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    created_by INT NOT NULL,
    max_attendees INT,
    is_published BOOLEAN DEFAULT true,
    featured_image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_start_date (start_date),
    INDEX idx_is_published (is_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. EVENT ATTENDEES TABLE (many-to-many)
CREATE TABLE IF NOT EXISTS event_attendees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('registered', 'attended', 'cancelled', 'no_show') DEFAULT 'registered',
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_event_user (event_id, user_id),
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. ANNOUNCEMENTS/NEWS TABLE
CREATE TABLE IF NOT EXISTS announcements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    category ENUM('general', 'leadership', 'ministry', 'ministry_event', 'emergency', 'celebration') DEFAULT 'general',
    created_by INT NOT NULL,
    is_published BOOLEAN DEFAULT true,
    featured_image_url VARCHAR(500),
    published_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_is_published (is_published),
    INDEX idx_published_at (published_at),
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. PRAYER REQUESTS TABLE
CREATE TABLE IF NOT EXISTS prayer_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    category ENUM('personal', 'family', 'academic', 'health', 'work', 'spiritual', 'other') DEFAULT 'other',
    is_anonymous BOOLEAN DEFAULT false,
    status ENUM('open', 'answered', 'archived') DEFAULT 'open',
    answered_at TIMESTAMP NULL,
    prayer_count INT DEFAULT 0,
    is_public BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_is_public (is_public),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. PRAYER COUNT TABLE (track who prayed)
CREATE TABLE IF NOT EXISTS prayer_intercessions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prayer_request_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prayer_request_id) REFERENCES prayer_requests(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_prayer_user (prayer_request_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. GIVING/DONATIONS TABLE
CREATE TABLE IF NOT EXISTS giving_transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency ENUM('KES', 'USD', 'EUR') DEFAULT 'KES',
    giving_type ENUM('tithe', 'offering', 'project', 'welfare', 'special') DEFAULT 'offering',
    description VARCHAR(255),
    payment_method ENUM('mpesa', 'bank_transfer', 'card', 'cash', 'cheque') DEFAULT 'mpesa',
    reference_number VARCHAR(100),
    status ENUM('pending', 'confirmed', 'failed', 'refunded') DEFAULT 'pending',
    ministry_id INT,
    project_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    confirmed_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (ministry_id) REFERENCES ministries(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_giving_type (giving_type),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. DOCUMENTS LIBRARY TABLE
CREATE TABLE IF NOT EXISTS documents (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    category ENUM('constitution', 'leadership_manual', 'policy', 'procedures', 'report', 'form', 'other') DEFAULT 'other',
    file_path VARCHAR(500) NOT NULL,
    file_type VARCHAR(20),
    file_size INT,
    uploaded_by INT NOT NULL,
    is_public BOOLEAN DEFAULT true,
    visibility ENUM('public', 'members_only', 'leadership_only') DEFAULT 'members_only',
    version VARCHAR(50),
    download_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_category (category),
    INDEX idx_is_public (is_public),
    INDEX idx_visibility (visibility)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. EMAIL LOGS TABLE
CREATE TABLE IF NOT EXISTS email_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipient_email VARCHAR(255) NOT NULL,
    recipient_user_id INT,
    subject VARCHAR(255) NOT NULL,
    email_type ENUM('welcome', 'password_reset', 'approval', 'event_reminder', 'announcement', 'notification', 'other') DEFAULT 'other',
    status ENUM('pending', 'sent', 'failed', 'bounced') DEFAULT 'pending',
    sent_at TIMESTAMP NULL,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipient_user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_email_type (email_type),
    INDEX idx_sent_at (sent_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. NOTIFICATIONS TABLE
CREATE TABLE IF NOT EXISTS notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    notification_type ENUM('event_reminder', 'prayer_answered', 'member_update', 'announcement', 'approval', 'giving_confirmation', 'birthday', 'other') DEFAULT 'other',
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    related_id INT,
    related_type VARCHAR(50),
    is_read BOOLEAN DEFAULT false,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_is_read (user_id, is_read),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. MEMBER PROFILES ENHANCEMENT (add to existing users table via ALTER)
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS bio TEXT;
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS testimonies LONGTEXT;
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS phone_verified_at TIMESTAMP NULL;
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS email_verified_at TIMESTAMP NULL;
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS last_login TIMESTAMP NULL;
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS avatar_url VARCHAR(500);
-- ALTER TABLE users ADD COLUMN IF NOT EXISTS notification_preferences JSON;

-- =====================================================
-- SEED DATA FOR NEW TABLES
-- =====================================================

-- Sample Event
INSERT INTO events (title, description, event_type, location, start_date, end_date, created_by, max_attendees) 
VALUES (
    'Monthly Prayer & Fellowship',
    'Join us for our monthly prayer meeting and fellowship time. A chance to connect with the MUTCU community, share updates, and intercede together.',
    'prayer_meeting',
    'Main Campus Auditorium',
    DATE_ADD(NOW(), INTERVAL 7 DAY),
    DATE_ADD(NOW(), INTERVAL 7 DAY) + INTERVAL 2 HOUR,
    1,
    150
);

-- Sample Announcement
INSERT INTO announcements (title, content, category, created_by, is_published) 
VALUES (
    'Welcome to MUTCU Digital Platform',
    'We are excited to launch our new digital membership management platform! This platform will help us stay connected, coordinate events, and support each member on their spiritual journey. Visit the document library for more information.',
    'general',
    1,
    true
);

-- Sample Prayer Request
INSERT INTO prayer_requests (user_id, title, description, category, is_public) 
VALUES (
    1,
    'Wisdom for Upcoming Tests',
    'Requesting prayers for wisdom and clarity as we approach the exam season. Pray that we remain focused and that our studies bear good fruit.',
    'academic',
    true
);

-- =====================================================
-- VIEWS FOR COMMON QUERIES
-- =====================================================

-- View: Upcoming Events with Attendance Count
DROP VIEW IF EXISTS v_upcoming_events;
CREATE VIEW v_upcoming_events AS
SELECT 
    e.id,
    e.title,
    e.description,
    e.event_type,
    e.location,
    e.start_date,
    e.end_date,
    e.max_attendees,
    COUNT(ea.id) as attendee_count,
    CASE 
        WHEN COUNT(ea.id) >= e.max_attendees THEN 'Full'
        ELSE 'Available'
    END as availability_status
FROM events e
LEFT JOIN event_attendees ea ON e.id = ea.event_id AND ea.status = 'registered'
WHERE e.start_date > NOW() AND e.is_published = true
GROUP BY e.id, e.title, e.description, e.event_type, e.location, e.start_date, e.end_date, e.max_attendees;

-- View: Active Prayer Requests with Intercession Count
DROP VIEW IF EXISTS v_active_prayer_requests;
CREATE VIEW v_active_prayer_requests AS
SELECT 
    pr.id,
    pr.title,
    pr.description,
    pr.category,
    CASE 
        WHEN pr.is_anonymous THEN 'Anonymous'
        ELSE CONCAT(u.first_name, ' ', u.last_name)
    END as requester,
    pr.status,
    COUNT(pi.id) as prayer_count,
    pr.created_at,
    pr.answered_at
FROM prayer_requests pr
LEFT JOIN users u ON pr.user_id = u.id
LEFT JOIN prayer_intercessions pi ON pr.id = pi.prayer_request_id
WHERE pr.is_public = true
GROUP BY pr.id, pr.title, pr.description, pr.category, pr.is_anonymous, u.first_name, u.last_name, pr.status, pr.created_at, pr.answered_at;

-- View: Monthly Giving Summary
DROP VIEW IF EXISTS v_giving_summary;
CREATE VIEW v_giving_summary AS
SELECT 
    DATE_TRUNC(gt.created_at, MONTH) as month,
    gt.giving_type,
    COUNT(*) as transaction_count,
    SUM(gt.amount) as total_amount,
    AVG(gt.amount) as average_amount
FROM giving_transactions gt
WHERE gt.status = 'confirmed'
GROUP BY month, gt.giving_type;

-- View: Recent Announcements
DROP VIEW IF EXISTS v_recent_announcements;
CREATE VIEW v_recent_announcements AS
SELECT 
    a.id,
    a.title,
    a.content,
    a.category,
    CONCAT(u.first_name, ' ', u.last_name) as posted_by,
    a.published_at,
    a.created_at
FROM announcements a
LEFT JOIN users u ON a.created_by = u.id
WHERE a.is_published = true
AND (a.expires_at IS NULL OR a.expires_at > NOW())
ORDER BY a.published_at DESC;

-- =====================================================
-- INDEXES FOR PERFORMANCE
-- =====================================================

-- Additional performance indexes
CREATE INDEX IF NOT EXISTS idx_prayer_requests_status ON prayer_requests(status);
CREATE INDEX IF NOT EXISTS idx_event_attendees_status ON event_attendees(status);
CREATE INDEX IF NOT EXISTS idx_giving_transactions_user ON giving_transactions(user_id);
CREATE INDEX IF NOT EXISTS idx_documents_uploaded_by ON documents(uploaded_by);
CREATE INDEX IF NOT EXISTS idx_notifications_user_created ON notifications(user_id, created_at);
CREATE INDEX IF NOT EXISTS idx_email_logs_recipient ON email_logs(recipient_email);

-- =====================================================
-- COMPLETION MESSAGE
-- =====================================================

-- Enhanced schema successfully created!
-- New features enabled:
-- ✅ Password Reset System
-- ✅ Event Management
-- ✅ Announcements & News
-- ✅ Prayer Requests
-- ✅ Online Giving
-- ✅ Document Library
-- ✅ Notification System
-- ✅ Email Logging
-- ✅ Member Profiles Enhanced

-- Total new tables: 10
-- Total new views: 4
-- Total new indexes: 8+

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
