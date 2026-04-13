<?php
/**
 * Register Page
 */
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $registration_number = trim($_POST['registration_number'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');
    $year_of_study_id = $_POST['year_of_study_id'] ?? 1;

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($registration_number) || empty($password)) {
        $error = 'All fields are required.';
    } elseif ($password !== $password_confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
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

            // Check if email exists
            $checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $checkStmt->execute([$email]);
            if ($checkStmt->fetch()) {
                $error = 'Email already registered.';
            } else {
                // Check if registration number exists
                $checkStmt = $pdo->prepare('SELECT id FROM users WHERE registration_number = ?');
                $checkStmt->execute([$registration_number]);
                if ($checkStmt->fetch()) {
                    $error = 'Registration number already used.';
                } else {
                    // Create new user
                    $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
                    $insertStmt = $pdo->prepare(
                        'INSERT INTO users (first_name, last_name, email, registration_number, password_hash, year_of_study_id, member_status_id) 
                         VALUES (?, ?, ?, ?, ?, ?, 2)'
                    );
                    $insertStmt->execute([$first_name, $last_name, $email, $registration_number, $password_hash, $year_of_study_id]);

                    $success = 'Registration successful! You can now login.';
                }
            }
        } catch (PDOException $e) {
            $error = 'Database error. Please try again later.';
        }
    }
}

// Get years of study for dropdown
$years = [];
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=mutcu_membership;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->query('SELECT id, display_name FROM year_of_study ORDER BY id');
    $years = $stmt->fetchAll();
} catch (Exception $e) {
    // Fallback if database isn't accessible
    $years = [
        ['id' => 1, 'display_name' => 'Year 1 (Anza FYT)'],
        ['id' => 2, 'display_name' => 'Year 2 (Endelea 1)'],
        ['id' => 3, 'display_name' => 'Year 3 (Endelea 2)'],
        ['id' => 4, 'display_name' => 'Year 4 (Vuka FiT)'],
        ['id' => 5, 'display_name' => 'Year 5 (Vuka FiT)'],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MUTCU</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #04003d 0%, #1a004d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
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
            margin-bottom: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #04003d;
        }

        .error {
            background: #f8d7da;
            border: 2px solid #f5c6cb;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success {
            background: #d4edda;
            border: 2px solid #c3e6cb;
            color: #155724;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #04003d;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #03002d;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #04003d;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            margin-bottom: 20px;
        }

        .back-link a {
            color: #04003d;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="back-link">
            <a href="../index.php">← Back to Home</a>
        </div>

        <h1>Create Account</h1>
        <p class="subtitle">Join MUTCU today</p>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success">
                <?php echo htmlspecialchars($success); ?><br>
                <a href="login.php" style="color: #155724; font-weight: 600;">Login now →</a>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="John" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="your@email.com" required>
            </div>

            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" id="registration_number" name="registration_number" placeholder="e.g., REG123456" required>
            </div>

            <div class="form-group">
                <label for="year_of_study_id">Year of Study</label>
                <select id="year_of_study_id" name="year_of_study_id" required>
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo $year['id']; ?>"><?php echo htmlspecialchars($year['display_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Min 6 characters" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
