<?php
/**
 * Database Setup Script
 * Run this once to initialize the database
 * Access via: http://localhost/mutcu_membership/backend/setup.php
 */

require_once __DIR__ . '/config/Config.php';

// Only allow from localhost in development
$allowedIPs = ['127.0.0.1', 'localhost', '::1'];
$clientIP = $_SERVER['REMOTE_ADDR'];

if (APP_ENV === 'production' && !in_array($clientIP, $allowedIPs)) {
    die('Setup script not available in production');
}

// Connect to MySQL without selecting database
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Read schema file
$schemaFile = __DIR__ . '/database/schema.sql';
if (!file_exists($schemaFile)) {
    die('Schema file not found: ' . $schemaFile);
}

$schema = file_get_contents($schemaFile);

// Split queries and execute
$queries = array_filter(array_map('trim', explode(';', $schema)));

$successCount = 0;
$errorCount = 0;
$errors = [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUTCU Database Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #04003d;
            margin-bottom: 20px;
        }
        .status {
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: 500;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .log {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            margin: 20px 0;
        }
        .log-entry {
            margin: 5px 0;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .log-entry.ok {
            color: green;
        }
        .log-entry.error {
            color: red;
        }
        button {
            background: #04003d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }
        button:hover {
            background: #03002d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 MUTCU Database Setup</h1>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="log">
                <?php
                foreach ($queries as $query) {
                    if (strlen(trim($query)) > 5) {
                        try {
                            $pdo->exec($query);
                            echo '<div class="log-entry ok">✓ Executed: ' . htmlspecialchars(substr($query, 0, 80)) . '...</div>';
                            $successCount++;
                        } catch (PDOException $e) {
                            echo '<div class="log-entry error">✗ Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                            $errorCount++;
                            $errors[] = $e->getMessage();
                        }
                    }
                }
                ?>
            </div>

            <?php if ($errorCount === 0): ?>
                <div class="status success">
                    ✓ Database setup completed successfully!<br>
                    <strong><?php echo $successCount; ?></strong> queries executed without errors.
                </div>
                <div class="info">
                    <strong>Next Steps:</strong><br>
                    1. Update your React frontend to point to this backend API<br>
                    2. Backend URL: http://localhost/mutcu_membership/backend/api/<br>
                    3. Default admin: Create one via registration, then manually update member_status to Active
                </div>
            <?php else: ?>
                <div class="status error">
                    ⚠ Setup completed with errors<br>
                    <strong><?php echo $successCount; ?></strong> successful | <strong><?php echo $errorCount; ?></strong> failed
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="info">
                This script will create the MUTCU database schema and initialize seed data.
            </div>
            <form method="POST">
                <p><strong>⚠ Warning:</strong> This will create the database and all tables. Existing data may be affected.</p>
                <button type="submit">Proceed with Database Setup</button>
            </form>
        <?php endif; ?>

    </div>
</body>
</html>
