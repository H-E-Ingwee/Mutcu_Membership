<?php
/**
 * Simple Database Setup Script
 * Place in root and run: http://localhost/mutcu_membership/database-setup.php
 */

// Don't require config - create connection directly
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

try {
    // Connect to MySQL server (no database selected yet)
    $pdo = new PDO(
        "mysql:host=$db_host",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    
    // Drop existing database if it exists
    try {
        $pdo->exec("DROP DATABASE IF EXISTS `mutcu_membership`");
    } catch (Exception $e) {
        // Ignore if database doesn't exist
    }
    
    // Read schema file
    $schema_file = __DIR__ . '/backend/database/schema.sql';
    
    if (!file_exists($schema_file)) {
        die("❌ Schema file not found: $schema_file");
    }
    
    $schema = file_get_contents($schema_file);
    
    // Better SQL query splitting that respects quoted strings
    $queries = [];
    $current_query = '';
    $in_string = false;
    $string_char = null;
    
    for ($i = 0; $i < strlen($schema); $i++) {
        $char = $schema[$i];
        $next_char = $i + 1 < strlen($schema) ? $schema[$i + 1] : '';
        
        // Handle string delimiters
        if (($char === '"' || $char === "'") && ($i === 0 || $schema[$i - 1] !== '\\')) {
            if (!$in_string) {
                $in_string = true;
                $string_char = $char;
            } elseif ($char === $string_char) {
                $in_string = false;
            }
        }
        
        // Check for statement terminator
        if ($char === ';' && !$in_string) {
            $current_query .= $char;
            $trimmed = trim($current_query);
            // Only add non-empty, non-comment queries
            if (strlen($trimmed) > 5 && !preg_match('/^--/', $trimmed)) {
                $queries[] = $trimmed;
            }
            $current_query = '';
        } else {
            $current_query .= $char;
        }
    }
    
    // Add any remaining query
    $trimmed = trim($current_query);
    if (strlen($trimmed) > 5 && !preg_match('/^--/', $trimmed)) {
        $queries[] = $trimmed;
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
            h1 { color: #04003d; }
            .status { padding: 15px; border-radius: 4px; margin: 20px 0; }
            .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
            .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
            .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
            .log { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; border-radius: 4px; max-height: 500px; overflow-y: auto; font-family: monospace; font-size: 12px; }
            .log-entry { padding: 3px 0; border-bottom: 1px solid #eee; }
            .log-entry.ok { color: green; }
            .log-entry.error { color: red; }
            button { background: #04003d; color: white; border: none; padding: 12px 24px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: 600; }
            button:hover { background: #03002d; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🔧 MUTCU Database Setup</h1>
            
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="log">
                    <?php
                    $success = 0;
                    $error = 0;
                    
                    // Execute CREATE DATABASE first
                    echo '<div class="log-entry ok">Creating database...</div>';
                    try {
                        $pdo->exec("DROP DATABASE IF EXISTS `mutcu_membership`");
                        echo '<div class="log-entry ok">✓ Dropped old database</div>';
                    } catch (Exception $e) {
                        echo '<div class="log-entry ok">✓ Old database not found</div>';
                    }
                    
                    try {
                        $pdo->exec("CREATE DATABASE IF NOT EXISTS `mutcu_membership` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                        echo '<div class="log-entry ok">✓ Created database mutcu_membership</div>';
                        $success++;
                    } catch (PDOException $e) {
                        echo '<div class="log-entry error">✗ Failed to create database: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        $error++;
                    }
                    
                    // Now reconnect to the new database
                    try {
                        $pdo = new PDO(
                            "mysql:host=$db_host;dbname=mutcu_membership;charset=utf8mb4",
                            $db_user,
                            $db_pass,
                            [
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            ]
                        );
                        echo '<div class="log-entry ok">✓ Connected to mutcu_membership database</div>';
                    } catch (PDOException $e) {
                        echo '<div class="log-entry error">✗ Failed to connect to database: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        die('</div></div></body></html>');
                    }
                    
                    // Execute all other queries
                    foreach ($queries as $query) {
                        if (trim($query) === '' || stripos(trim($query), 'CREATE DATABASE') === 0 || stripos(trim($query), 'USE ') === 0) {
                            continue; // Skip empty, CREATE DATABASE, and USE statements
                        }
                        
                        $q_display = preg_replace('/\s+/', ' ', substr($query, 0, 70));
                        try {
                            $pdo->exec($query);
                            echo '<div class="log-entry ok">✓ ' . htmlspecialchars($q_display) . '...</div>';
                            $success++;
                        } catch (PDOException $e) {
                            echo '<div class="log-entry error">✗ Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                            $error++;
                        }
                    }
                    ?>
                </div>
                
                <?php if ($error === 0): ?>
                    <div class="status success">
                        ✅ Database setup completed successfully!<br>
                        <strong><?php echo $success; ?></strong> queries executed without errors.
                    </div>
                    <div class="status info">
                        <strong>Next Steps:</strong><br>
                        1. Go to the application homepage<br>
                        2. Register a new member<br>
                        3. Login with your credentials<br>
                        4. Explore the system features
                    </div>
                <?php else: ?>
                    <div class="status error">
                        ⚠ Setup completed with issues<br>
                        <strong><?php echo $success; ?></strong> successful | <strong><?php echo $error; ?></strong> failed
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="status info">
                    This script will initialize the MUTCU database and create all required tables with seed data.
                </div>
                <form method="POST">
                    <p><strong>⚠️ Warning:</strong> This will drop and recreate the database. Existing data will be lost.</p>
                    <button type="submit">Proceed with Database Setup</button>
                </form>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
    
} catch (PDOException $e) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Database Connection Error</title>
        <style>
            body { font-family: Arial; max-width: 800px; margin: 50px auto; padding: 20px; }
            .error { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 4px; border: 1px solid #f5c6cb; }
        </style>
    </head>
    <body>
        <div class="error">
            <h2>❌ Connection Error</h2>
            <p><strong>Error:</strong> <?php echo htmlspecialchars($e->getMessage()); ?></p>
            <p><strong>Make sure:</strong></p>
            <ul>
                <li>MySQL is running in XAMPP Control Panel</li>
                <li>Database credentials are correct (localhost / root / no password)</li>
            </ul>
        </div>
    </body>
    </html>
    <?php
}
?>
