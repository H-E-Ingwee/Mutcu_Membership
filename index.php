<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUTCU Digital Membership System</title>
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
        }

        .container {
            max-width: 1200px;
            padding: 20px;
        }

        .landing {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            flex-wrap: wrap;
        }

        .content {
            flex: 1;
            min-width: 300px;
            color: white;
        }

        .content h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .content p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            border: 2px solid white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: #ff6b35;
            border-color: #ff6b35;
            color: white;
        }

        .btn-primary:hover {
            background: #ff5122;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border-color: white;
            color: white;
        }

        .btn-secondary:hover {
            background: white;
            color: #04003d;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }

        .features {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 12px;
        }

        .features h2 {
            color: white;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .feature-item {
            margin-bottom: 25px;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-item strong {
            display: block;
            margin-bottom: 8px;
            color: #ff6b35;
        }

        .feature-item p {
            font-size: 0.95rem;
            margin: 0;
        }

        @media (max-width: 768px) {
            .landing {
                flex-direction: column;
                gap: 40px;
            }

            .content h1 {
                font-size: 2.5rem;
            }

            .cta-buttons {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="landing">
            <div class="content">
                <h1>MUTCU Digital Membership System</h1>
                <p>Streamline member management, track engagement, and build community through our comprehensive digital platform.</p>
                <p style="font-size: 0.95rem; opacity: 0.8;">Get started by logging in or creating a new account to join the Christian Union.</p>
                
                <div class="cta-buttons">
                    <a href="pages/login.php" class="btn btn-primary">Login</a>
                    <a href="pages/register.php" class="btn btn-secondary">Register</a>
                </div>
            </div>

            <div class="features">
                <h2>Features</h2>
                
                <div class="feature-item">
                    <strong>📋 Member Management</strong>
                    <p>Manage member profiles, roles, and permissions efficiently.</p>
                </div>

                <div class="feature-item">
                    <strong>🏛️ Leadership Directory</strong>
                    <p>View and connect with union leadership and ministry coordinators.</p>
                </div>

                <div class="feature-item">
                    <strong>📢 Announcements</strong>
                    <p>Stay updated on union events, meetings, and important notices.</p>
                </div>

                <div class="feature-item">
                    <strong>🎯 Ministry Groups</strong>
                    <p>Join and participate in various ministry committees and initiatives.</p>
                </div>

                <div class="feature-item">
                    <strong>🔐 Secure Access</strong>
                    <p>Your data is protected with modern security standards.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
