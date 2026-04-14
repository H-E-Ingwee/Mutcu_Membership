<?php
// MUTCU Landing Page - Minimalistic PHP Version
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUTCU - Murang'a University Christian Union</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        
        header {
            background: linear-gradient(135deg, #04003d 0%, #1a0066 100%);
            color: white;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 20px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            transition: opacity 0.3s;
            font-size: 15px;
        }
        
        nav a:hover {
            opacity: 0.8;
        }
        
        .auth-buttons {
            display: flex;
            gap: 12px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-login:hover {
            background: white;
            color: #04003d;
        }
        
        .btn-register {
            background: #ff9700;
            color: white;
        }
        
        .btn-register:hover {
            background: #ff7b00;
        }
        
        .hero {
            background: linear-gradient(135deg, #04003d 0%, #1a0066 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .hero-content .subtitle {
            font-size: 18px;
            margin-bottom: 10px;
            opacity: 0.95;
        }
        
        .hero-content .tagline {
            font-size: 16px;
            margin-bottom: 40px;
            opacity: 0.85;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: #ff9700;
            color: white;
            padding: 14px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #ff7b00;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            background: white;
            color: #04003d;
        }
        
        .features-section {
            padding: 80px 20px;
            background: #f9f9f9;
        }
        
        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            color: #04003d;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .feature h3 {
            margin-top: 15px;
            margin-bottom: 10px;
            color: #04003d;
            font-size: 18px;
        }
        
        .feature p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .info-section {
            padding: 80px 20px;
            background: white;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }
        
        .info-block h3 {
            color: #04003d;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .info-block p {
            color: #666;
            font-size: 15px;
            line-height: 1.8;
        }
        
        footer {
            background: #04003d;
            color: white;
            padding: 40px 20px;
            text-align: center;
            font-size: 14px;
        }
        
        footer a {
            color: #ff9700;
            text-decoration: none;
        }
        
        footer a:hover {
            text-decoration: underline;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            margin: 0 15px;
        }
        
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                gap: 15px;
            }
            
            nav {
                display: none;
            }
            
            .auth-buttons {
                width: 100%;
            }
            
            .auth-buttons .btn {
                flex: 1;
            }
            
            .hero-content h1 {
                font-size: 32px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
            .cta-buttons {
                flex-direction: column;
            }
            
            .btn-primary,
            .btn-secondary {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <div class="logo">
            <div class="logo-icon">M</div>
            <span>MUTCU</span>
        </div>
        <nav>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="auth-buttons">
            <a href="pages/login.php" class="btn btn-login">Login</a>
            <a href="pages/register.php" class="btn btn-register">Register</a>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="container" style="max-width: 800px;">
        <div class="hero-content">
            <h1>Welcome to MUTCU</h1>
            <p class="subtitle">Murang'a University of Technology Christian Union</p>
            <p class="tagline">Inspire Love, Hope & Godliness through Digital Community Management</p>
            <div class="cta-buttons">
                <a href="pages/register.php" class="btn-primary">Join Now</a>
                <a href="pages/login.php" class="btn-secondary">Login</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="info-section" id="about">
    <div class="container">
        <h2 class="section-title">About MUTCU</h2>
        <div class="info-grid">
            <div class="info-block">
                <h3>Our Mission</h3>
                <p>The Murang'a University of Technology Christian Union (MUTCU) is a student-led organization dedicated to fostering spiritual growth, community service, and Christian leadership among students. We create a supportive community where students develop their faith and talents.</p>
            </div>
            <div class="info-block">
                <h3>Our Vision</h3>
                <p>To build a vibrant Christian community that transforms lives through faith, service, and leadership. We are committed to the core values of Integrity, Service, Excellence, Unity, and Godliness.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container">
        <h2 class="section-title">Platform Features</h2>
        <div class="features-grid">
            <div class="feature">
                <h3>📋 Member Directory</h3>
                <p>Connect with members across all years and courses. Find ministry coordinators and build meaningful relationships.</p>
            </div>
            <div class="feature">
                <h3>📅 Event Management</h3>
                <p>View upcoming events, prayer meetings, and outreach programs. RSVP and stay updated with notifications.</p>
            </div>
            <div class="feature">
                <h3>🤲 Prayer Requests</h3>
                <p>Share prayer requests with the community. Intercede for fellow members and celebrate answered prayers.</p>
            </div>
            <div class="feature">
                <h3>📰 News & Updates</h3>
                <p>Stay informed with latest announcements, leadership updates, and organizational news.</p>
            </div>
            <div class="feature">
                <h3>📄 Documents</h3>
                <p>Access constitution, leadership manual, policies, and other important documents anytime.</p>
            </div>
            <div class="feature">
                <h3>❤️ Supporting Needs</h3>
                <p>Contribute to member welfare, projects, and charitable causes. Make a real difference.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="info-section" id="contact">
    <div class="container">
        <h2 class="section-title">Get in Touch</h2>
        <div class="info-grid">
            <div class="info-block">
                <h3>📍 Location</h3>
                <p>Murang'a University of Technology<br>Murang'a, Kenya</p>
            </div>
            <div class="info-block">
                <h3>📧 Email</h3>
                <p><a href="mailto:mutcu@mut.ac.ke">mutcu@mut.ac.ke</a><br><a href="mailto:info@mutcu.org">info@mutcu.org</a></p>
            </div>
            <div class="info-block">
                <h3>📞 Phone</h3>
                <p>+254 712 345 678<br>+254 701 234 567</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-links">
        <a href="#about">About</a>
        <a href="#features">Features</a>
        <a href="#contact">Contact</a>
        <a href="pages/login.php">Login</a>
        <a href="pages/register.php">Register</a>
    </div>
    <p>&copy; 2024-2026 Murang'a University of Technology Christian Union (MUTCU)</p>
    <p style="margin-top: 10px; opacity: 0.8;">Inspire Love, Hope & Godliness</p>
</footer>

</body>
</html>
