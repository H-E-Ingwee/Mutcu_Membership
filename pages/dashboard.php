<?php
/**
 * Dashboard Page
 */
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user info from database
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=mutcu_membership;charset=utf8mb4',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    $stmt = $pdo->prepare(
        'SELECT u.*, mt.name as membership_type, ms.status_name, yos.display_name as year_of_study
         FROM users u
         LEFT JOIN membership_types mt ON u.membership_type_id = mt.id
         LEFT JOIN member_status ms ON u.member_status_id = ms.id
         LEFT JOIN year_of_study yos ON u.year_of_study_id = yos.id
         WHERE u.id = ?'
    );
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        session_destroy();
        header('Location: login.php');
        exit();
    }

    // Get user's ministry roles
    $ministryStmt = $pdo->prepare(
        'SELECT umr.*, m.name as ministry_name, lr.role_name
         FROM user_ministry_roles umr
         JOIN ministries m ON umr.ministry_id = m.id
         JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         WHERE umr.user_id = ? AND umr.is_active = TRUE
         ORDER BY umr.is_primary_ministry DESC'
    );
    $ministryStmt->execute([$_SESSION['user_id']]);
    $ministries = $ministryStmt->fetchAll();

    // Get stats
    $statsStmt = $pdo->query(
        'SELECT COUNT(*) as total_members FROM users WHERE is_active = TRUE AND member_status_id = 1'
    );
    $stats = $statsStmt->fetch();

} catch (PDOException $e) {
    $user = null;
    $ministries = [];
    $stats = ['total_members' => 0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MUTCU</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        header {
            background: linear-gradient(135deg, #04003d 0%, #1a004d 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header-left p {
            font-size: 13px;
            opacity: 0.9;
        }

        .header-right {
            text-align: right;
        }

        .logout-btn {
            background: #ff6b35;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #ff5122;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .welcome-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .welcome-section h2 {
            color: #04003d;
            margin-bottom: 10px;
        }

        .user-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .info-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ff6b35;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .stat-number {
            font-size: 36px;
            color: #04003d;
            font-weight: 700;
        }

        .ministries-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .ministries-section h3 {
            color: #04003d;
            margin-bottom: 20px;
        }

        .ministry-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 12px;
            border-left: 4px solid #ff6b35;
        }

        .ministry-item strong {
            display: block;
            color: #04003d;
            margin-bottom: 5px;
        }

        .ministry-item small {
            color: #666;
        }

        .empty-state {
            text-align: center;
            color: #999;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-right {
                text-align: center;
            }

            .user-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="header-left">
                <h1>🙏 MUTCU Dashboard</h1>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?></p>
            </div>
            <div class="header-right">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <?php if ($user): ?>
            <div class="welcome-section">
                <h2>Your Profile</h2>
                <div class="user-info">
                    <div class="info-card">
                        <div class="info-label">Full Name</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Membership Status</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['status_name'] ?? 'N/A'); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Year of Study</div>
                        <div class="info-value"><?php echo htmlspecialchars($user['year_of_study'] ?? 'N/A'); ?></div>
                    </div>
                </div>
            </div>

            <div class="stats-section">
                <div class="stat-card">
                    <h3>Total Members</h3>
                    <div class="stat-number"><?php echo $stats['total_members'] ?? 0; ?></div>
                </div>
                <div class="stat-card">
                    <h3>Your Roles</h3>
                    <div class="stat-number"><?php echo count($ministries); ?></div>
                </div>
                <div class="stat-card">
                    <h3>Account Status</h3>
                    <div class="stat-number" style="color: #28a745; font-size: 20px;">Active</div>
                </div>
            </div>

            <?php if (count($ministries) > 0): ?>
                <div class="ministries-section">
                    <h3>Your Roles & Ministries</h3>
                    <?php foreach ($ministries as $ministry): ?>
                        <div class="ministry-item">
                            <strong><?php echo htmlspecialchars($ministry['role_name']); ?></strong>
                            <small>📍 <?php echo htmlspecialchars($ministry['ministry_name']); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="ministries-section">
                    <h3>Your Roles & Ministries</h3>
                    <div class="empty-state">
                        <p>You are not yet assigned to any ministries.</p>
                        <p style="margin-top: 10px; font-size: 14px;">Contact administrators to join a ministry.</p>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="welcome-section empty-state">
                <p>Unable to load user information. Please <a href="login.php">login again</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
