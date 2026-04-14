<?php
/**
 * Create SuperAdmin Account
 * Creates a new superadmin user with leadership role
 * Access via: http://localhost/mutcu_membership/create-superadmin.php
 */

// Only allow from localhost in development
$allowedIPs = ['127.0.0.1', 'localhost', '::1'];
$clientIP = $_SERVER['REMOTE_ADDR'];

if (!in_array($clientIP, $allowedIPs)) {
    die('⛔ This script can only be accessed from localhost');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $registration_number = trim($_POST['registration_number'] ?? '');
    $course = trim($_POST['course'] ?? '');

    // Validation
    if (empty($first_name)) {
        $error = 'First name is required.';
    } elseif (empty($last_name)) {
        $error = 'Last name is required.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Valid email is required.';
    } elseif (empty($password) || strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif (empty($registration_number)) {
        $error = 'Registration number is required.';
    } elseif (empty($course)) {
        $error = 'Course of study is required.';
    }

    if (!$error) {
        try {
            // Connect to database
            $pdo = new PDO(
                'mysql:host=localhost;dbname=mutcu_membership;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            // Check if email already exists
            $checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = ? OR registration_number = ?');
            $checkStmt->execute([$email, $registration_number]);
            if ($checkStmt->fetch()) {
                $error = 'Email or registration number already exists.';
            }

            if (!$error) {
                // Hash password
                $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);

                // Insert user
                $stmt = $pdo->prepare(
                    'INSERT INTO users (first_name, last_name, email, password_hash, registration_number, course_of_study, year_of_study_id, membership_type_id, member_status_id, is_active)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                );
                $stmt->execute([
                    $first_name,
                    $last_name,
                    $email,
                    $password_hash,
                    $registration_number,
                    $course,
                    1, // year_of_study_id (1st year)
                    1, // membership_type_id (Full)
                    1, // member_status_id (Active)
                    1  // is_active
                ]);

                $user_id = $pdo->lastInsertId();

                // Get Executive Council ministry (or create it)
                $ministryStmt = $pdo->prepare('SELECT id FROM ministries WHERE name = "Executive Council" LIMIT 1');
                $ministryStmt->execute();
                $ministry = $ministryStmt->fetch();
                
                if (!$ministry) {
                    // Create Executive Council ministry if it doesn't exist
                    $createMinistry = $pdo->prepare(
                        'INSERT INTO ministries (name, description, is_active) VALUES (?, ?, ?)'
                    );
                    $createMinistry->execute(['Executive Council', 'Main leadership body', 1]);
                    $ministry_id = $pdo->lastInsertId();
                } else {
                    $ministry_id = $ministry['id'];
                }

                // Get Chairperson leadership role (or create it)
                $roleStmt = $pdo->prepare('SELECT id FROM leadership_roles WHERE role_code = "CHAIRPERSON" LIMIT 1');
                $roleStmt->execute();
                $role = $roleStmt->fetch();
                
                if (!$role) {
                    // Create Chairperson role if it doesn't exist
                    $createRole = $pdo->prepare(
                        'INSERT INTO leadership_roles (role_code, role_name, role_type, authority_level, is_active)
                         VALUES (?, ?, ?, ?, ?)'
                    );
                    $createRole->execute(['CHAIRPERSON', 'Chairperson', 'Executive Council', 10, 1]);
                    $role_id = $pdo->lastInsertId();
                } else {
                    $role_id = $role['id'];
                }

                // Assign user to Executive Council with Chairperson role
                $assignStmt = $pdo->prepare(
                    'INSERT INTO user_ministry_roles (user_id, ministry_id, leadership_role_id, is_primary_ministry, is_active)
                     VALUES (?, ?, ?, ?, ?)'
                );
                $assignStmt->execute([$user_id, $ministry_id, $role_id, 1, 1]);

                // Log action
                $logStmt = $pdo->prepare(
                    'INSERT INTO audit_logs (action_type, entity_type, entity_id, performed_by_user_id)
                     VALUES (?, ?, ?, ?)'
                );
                $logStmt->execute(['CREATE_SUPERADMIN', 'User', $user_id, $user_id]);

                $success = "✅ Superadmin account created successfully!<br><br>
                           <strong>Login Credentials:</strong><br>
                           Email: <code>$email</code><br>
                           Password: <code>$password</code><br><br>
                           <strong>⚠️ Important:</strong><br>
                           • Save these credentials securely<br>
                           • Change password after first login<br>
                           • <a href='pages/login.php' style='color: #ff9700; font-weight: bold;'>Go to Login</a>";
            }
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create SuperAdmin Account - MUTCU</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #04003d 0%, #1a0066 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            padding: 40px;
        }
        
        h1 {
            color: #04003d;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input:focus {
            outline: none;
            border-color: #ff9700;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #04003d 0%, #1a0066 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 151, 0, 0.3);
        }
        
        .message {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .success a {
            color: #155724;
            text-decoration: none;
            font-weight: 600;
        }
        
        .success a:hover {
            text-decoration: underline;
        }
        
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
        }
        
        .success code {
            background: rgba(255, 255, 255, 0.6);
        }
        
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 13px;
            color: #856404;
            line-height: 1.6;
        }
        
        .welcome {
            text-align: center;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .welcome h2 {
            color: #04003d;
            margin-bottom: 5px;
            font-size: 18px;
        }
        
        .welcome p {
            color: #666;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Create SuperAdmin Account</h1>
        <p class="subtitle">Set up the first administrator account for MUTCU</p>
        
        <?php if ($error): ?>
            <div class="message error">
                <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="message success">
                <?php echo $success; ?>
            </div>
        <?php else: ?>
            <div class="welcome">
                <h2>Welcome to MUTCU Setup</h2>
                <p>Create your superadmin account to access the admin dashboard</p>
            </div>
            
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password (min 8 chars) *</label>
                    <input type="password" id="password" name="password" minlength="8" required>
                </div>
                
                <div class="form-group">
                    <label for="registration_number">Registration Number *</label>
                    <input type="text" id="registration_number" name="registration_number" required>
                </div>
                
                <div class="form-group">
                    <label for="course">Course of Study *</label>
                    <input type="text" id="course" name="course" placeholder="e.g. Computer Science" required>
                </div>
                
                <button type="submit">Create SuperAdmin Account</button>
            </form>
            
            <div class="warning-box">
                <strong>⚠️ Security Note:</strong><br>
                This script creates a user with admin privileges. Save your credentials securely and change the password after first login.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
