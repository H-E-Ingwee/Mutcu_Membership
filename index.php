<?php
// MUTCU Landing Page - PHP Version
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUTCU - Murang'a University Christian Union</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero {
            background: linear-gradient(135deg, #04003d 0%, #1a0066 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }
        
        .cta-button {
            display: inline-block;
            padding: 14px 40px;
            margin: 10px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid #ff9700;
        }
        
        .cta-button-primary {
            background: #ff9700;
            color: white;
        }
        
        .cta-button-primary:hover {
            background: #ff7b00;
            box-shadow: 0 8px 20px rgba(255, 151, 0, 0.4);
            transform: translateY(-2px);
        }
        
        .cta-button-secondary {
            background: transparent;
            color: #ff9700;
            border-color: #ff9700;
        }
        
        .cta-button-secondary:hover {
            background: #ff9700;
            color: white;
            box-shadow: 0 8px 20px rgba(255, 151, 0, 0.4);
            transform: translateY(-2px);
        }
        
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid #ff9700;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #ff9700;
            margin-bottom: 15px;
        }
        
        .stat-box {
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #ff9700;
        }
        
        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 10px;
        }
        
        .testimonial {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 4px solid #ff9700;
        }
        
        .testimonial-text {
            color: #666;
            margin-bottom: 15px;
            font-style: italic;
            line-height: 1.6;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: #04003d;
        }
        
        .testimonial-role {
            color: #ff9700;
            font-size: 0.9rem;
        }
        
        .footer {
            background: #04003d;
            color: white;
            padding: 50px 20px;
            text-align: center;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: #ff9700;
            text-decoration: none;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #ffb733;
            text-decoration: underline;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            display: inline-block;
            width: 45px;
            height: 45px;
            background: #ff9700;
            color: white;
            border-radius: 50%;
            line-height: 45px;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: #ffb733;
            transform: translateY(-3px);
        }
        
        .mobile-menu {
            display: none;
        }
        
        @media (max-width: 768px) {
            .hero {
                padding: 50px 20px;
                min-height: auto;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .desktop-menu {
                display: none;
            }
            
            .mobile-menu {
                display: block;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
        
        .floating-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #ff9700;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 151, 0, 0.4);
            transition: all 0.3s ease;
            z-index: 999;
        }
        
        .floating-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(255, 151, 0, 0.6);
        }
        
        @media (max-width: 768px) {
            .floating-button {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-yellow-500 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">M</span>
            </div>
            <span class="font-bold text-lg text-gray-800 hidden sm:inline">MUTCU</span>
        </div>
        
        <!-- Desktop Menu -->
        <div class="desktop-menu hidden md:flex space-x-6">
            <a href="#home" class="text-gray-700 hover:text-yellow-500 transition">Home</a>
            <a href="#about" class="text-gray-700 hover:text-yellow-500 transition">About</a>
            <a href="#features" class="text-gray-700 hover:text-yellow-500 transition">Features</a>
            <a href="#contact" class="text-gray-700 hover:text-yellow-500 transition">Contact</a>
        </div>
        
        <!-- Auth Buttons -->
        <div class="flex space-x-3">
            <a href="pages/login.php" class="px-4 py-2 text-gray-700 hover:text-yellow-500 transition font-medium" id="loginBtn">Login</a>
            <a href="pages/register.php" class="px-4 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition font-medium" id="registerBtn">Register</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="max-w-4xl mx-auto">
        <div style="animation: slideInDown 0.8s ease;">
            <h1>Welcome to MUTCU</h1>
            <p>Murang'a University of Technology Christian Union</p>
            <p style="font-size: 1.1rem; margin-bottom: 40px;">
                Inspire Love, Hope & Godliness through Digital Community Management
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="pages/register.php" class="cta-button cta-button-primary">
                    <i class="fas fa-user-plus"></i> Join Now
                </a>
                <a href="pages/login.php" class="cta-button cta-button-secondary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="bg-gradient-to-r from-blue-900 via-purple-900 to-blue-900 py-16 md:py-24">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-box">
                <div class="stat-number" data-target="1200">1200+</div>
                <div class="stat-label">Active Members</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" data-target="10">10</div>
                <div class="stat-label">Ministries</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" data-target="150">150+</div>
                <div class="stat-label">Monthly Events</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" data-target="98">98%</div>
                <div class="stat-label">Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">About MUTCU</h2>
        <div class="h-1 w-20 bg-yellow-500 mx-auto mb-10"></div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    The Murang'a University of Technology Christian Union (MUTCU) is a student-led organization dedicated to fostering spiritual growth, community service, and Christian leadership among students.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    We believe in creating a supportive community where students can develop their faith, talents, and character while making a positive impact on society.
                </p>
            </div>
            
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    To build a vibrant Christian community at Murang'a University of Technology that transforms lives through faith, service, and leadership.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    <strong>Core Values:</strong> Integrity, Service, Excellence, Unity, and Godliness
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 md:py-24">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Platform Features</h2>
        <div class="h-1 w-20 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Member Directory</h3>
                <p class="text-gray-600">Connect with members across all years and courses. Find ministry coordinators and build meaningful relationships.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Event Management</h3>
                <p class="text-gray-600">View upcoming events, prayer meetings, and outreach programs. RSVP and stay updated with notifications.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-prayer-hands"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Prayer Requests</h3>
                <p class="text-gray-600">Share prayer requests with the community. Intercede for fellow members and celebrate answered prayers.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-newspaper"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">News & Updates</h3>
                <p class="text-gray-600">Stay informed with latest announcements, leadership updates, and organizational news.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-file-pdf"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Documents</h3>
                <p class="text-gray-600">Access constitution, leadership manual, policies, and other important documents anytime.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Supporting Needs</h3>
                <p class="text-gray-600">Contribute to member welfare, projects, and charitable causes. Make a real difference.</p>
            </div>
        </div>
    </div>
</section>

<!-- Ministries Section -->
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Our Ministries</h2>
        <div class="h-1 w-20 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-piggy-bank text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Treasury</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-utensils text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Hospitality</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-music text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Music</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-praying-hands text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Prayer</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-globe text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Missions</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-book text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Bible Study</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-seedling text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Discipleship</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-palette text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Creative Arts</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-laptop text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Tech & Media</h4>
            </div>
            <div class="bg-white p-6 rounded-lg text-center hover:shadow-lg transition">
                <i class="fas fa-heart text-3xl text-yellow-500 mb-3"></i>
                <h4 class="font-bold text-gray-800">Welfare</h4>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Member Testimonials</h2>
        <div class="h-1 w-20 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="testimonial">
                <div class="testimonial-text">
                    "MUTCU has been instrumental in my spiritual journey. The community is welcoming, and I've grown so much through the various ministries and fellowship."
                </div>
                <div class="testimonial-author">Sarah Kipchoge</div>
                <div class="testimonial-role">2nd Year, Computer Science</div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-text">
                    "Being part of the leadership has taught me so much about service and integrity. This digital platform makes coordination seamless and keeps us connected."
                </div>
                <div class="testimonial-author">David Kariuki</div>
                <div class="testimonial-role">Chairperson, MUTCU</div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-text">
                    "The prayer requests feature has created such a beautiful culture of intercession. We really feel the power of collective prayer here."
                </div>
                <div class="testimonial-author">Grace Mwangi</div>
                <div class="testimonial-role">3rd Year, Business</div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-text">
                    "From events to document access, everything is organized and accessible. The platform has really elevated our organizational efficiency."
                </div>
                <div class="testimonial-author">James Omondi</div>
                <div class="testimonial-role">Secretary, MUTCU</div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-gradient-to-r from-blue-900 to-purple-900 py-16 md:py-24 text-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Join MUTCU?</h2>
        <p class="text-lg mb-8 opacity-90">
            Be part of a vibrant community dedicated to spiritual growth, service, and Christian leadership.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="pages/register.php" class="cta-button cta-button-primary">
                <i class="fas fa-user-plus"></i> Register Now
            </a>
            <a href="pages/login.php" class="cta-button cta-button-secondary">
                <i class="fas fa-sign-in-alt"></i> Already a Member?
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Get in Touch</h2>
        <div class="h-1 w-20 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div>
                <i class="fas fa-map-marker-alt text-4xl text-yellow-500 mb-4"></i>
                <h4 class="font-bold mb-2">Location</h4>
                <p class="text-gray-600">Murang'a University of Technology</p>
                <p class="text-gray-600">Murang'a, Kenya</p>
            </div>
            
            <div>
                <i class="fas fa-envelope text-4xl text-yellow-500 mb-4"></i>
                <h4 class="font-bold mb-2">Email</h4>
                <p class="text-gray-600">
                    <a href="mailto:mutcu@mut.ac.ke" class="text-yellow-600 hover:underline">
                        mutcu@mut.ac.ke
                    </a>
                </p>
                <p class="text-gray-600">info@mutcu.org</p>
            </div>
            
            <div>
                <i class="fas fa-phone text-4xl text-yellow-500 mb-4"></i>
                <h4 class="font-bold mb-2">Phone</h4>
                <p class="text-gray-600">+254 712 345 678</p>
                <p class="text-gray-600">+254 701 234 567</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="max-w-6xl mx-auto">
        <div class="footer-links">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
            <a href="backend/database/schema.sql" target="_blank">Constitution</a>
        </div>
        
        <div class="social-links">
            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
        
        <div style="margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px;">
            <p>&copy; 2024-2026 Murang'a University of Technology Christian Union (MUTCU)</p>
            <p style="font-size: 0.9rem; margin-top: 10px;">Inspire Love, Hope & Godliness</p>
        </div>
    </div>
</footer>

<!-- Floating Action Button -->
<a href="#" class="floating-button" title="Quick Actions" onclick="toggleMenu(event)">
    <i class="fas fa-comment-dots"></i>
</a>

<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Counter animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = parseInt(target.getAttribute('data-target'));
                let current = 0;
                const increment = finalNumber / 30;
                
                const interval = setInterval(() => {
                    current += increment;
                    if (current >= finalNumber) {
                        target.textContent = finalNumber + (target.parentElement.textContent.includes('+') ? '+' : (target.parentElement.textContent.includes('%') ? '%' : ''));
                        clearInterval(interval);
                    } else {
                        target.textContent = Math.floor(current);
                    }
                }, 50);
                
                observer.unobserve(target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.stat-number').forEach(el => {
        observer.observe(el);
    });
    
    // Mobile menu toggle would go here
    function toggleMenu(e) {
        e.preventDefault();
        alert('Feature coming soon: Live chat support for MUTCU members!');
    }
    
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'l' && e.ctrlKey) {
            window.location.href = 'pages/login.php';
        }
        if (e.key === 'r' && e.ctrlKey) {
            window.location.href = 'pages/register.php';
        }
    });
</script>

<style>
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</body>
</html>
