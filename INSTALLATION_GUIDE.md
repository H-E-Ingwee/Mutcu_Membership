# MUTCU Digital Membership System - Installation & Setup Guide

## 📋 Prerequisites

- **PHP:** 8.0 or higher
- **MySQL/MariaDB:** 5.7 or higher
- **Apache:** With mod_rewrite enabled
- **Composer:** (Optional, for future dependency management)
- **Node.js:** (For React frontend development)

## 🖥️ System Architecture

```
mutcu_membership/
├── backend/                    # PHP REST API
│   ├── config/               # Configuration files
│   ├── api/                  # API endpoints
│   ├── utils/                # Utility classes
│   ├── middleware/           # Authentication & CORS
│   ├── database/             # Database schema
│   ├── index.php             # API Router
│   ├── setup.php             # Database setup
│   └── .htaccess             # Apache configuration
├── frontend/                   # React Application (Vite/CRA)
└── API_DOCUMENTATION.md       # API Reference
```

## 🚀 Installation Steps

### Step 1: Environment Setup

1. **Open XAMPP Control Panel**
   - Start Apache
   - Start MySQL

2. **Verify Installation**
   - PHP: `php -v` (should be 8.0+)
   - MySQL: `mysql --version`

### Step 2: Database Setup

1. **Access the setup script:**
   ```
   http://localhost/mutcu_membership/backend/setup.php
   ```

2. **Click "Proceed with Database Setup"**
   - This will:
     - Create the `mutcu_membership` database
     - Create all required tables
     - Insert seed data (ministries, roles, etc.)
     - Create views for common queries

3. **Verify in phpMyAdmin:**
   - Navigate to `http://localhost/phpmyadmin`
   - Verify `mutcu_membership` database exists
   - Check tables are created

### Step 3: Configuration

The API is pre-configured in `backend/config/Config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');         // XAMPP default is empty
define('DB_NAME', 'mutcu_membership');
define('APP_ENV', 'development');
```

**⚠️ For Production:**
- Change `APP_ENV` to `'production'`
- Set strong database passwords
- Update `JWT_SECRET`
- Configure SMTP for email

### Step 4: Testing the API

1. **Test Login Endpoint:**
   ```bash
   curl -X POST http://localhost/mutcu_membership/backend/api/auth/login \
     -H "Content-Type: application/json" \
     -d '{"email":"test@example.com","password":"TestPassword123"}'
   ```

2. **First Registration & Login:**
   - Register a new member via `/api/auth/register`
   - Get the returned token
   - Use token for authenticated requests

### Step 5: Frontend Integration

1. **Update React API Base URL** in your frontend `.env`:
   ```
   VITE_API_BASE_URL=http://localhost/mutcu_membership/backend/api
   ```

2. **Configure CORS** (already done in `backend/middleware/CORS.php`):
   ```php
   define('ALLOWED_ORIGINS', [
       'http://localhost:3000',  // React dev server
       'http://localhost:5173',  // Vite dev server
   ]);
   ```

## 📚 API Endpoints Quick Reference

| Method | Endpoint | Public | Admin | Description |
|--------|----------|--------|-------|-------------|
| POST | `/auth/login` | ✓ | ✓ | User login |
| POST | `/auth/register` | ✓ | ✓ | New member registration |
| GET | `/members/list` | ✗ | ✓ | All members (paginated) |
| GET | `/members/get?id=X` | Partial | ✓ | Member details |
| POST | `/members/approve` | ✗ | ✓ | Approve pending member |
| GET | `/admin/dashboard` | ✗ | ✓ | Admin dashboard stats |
| POST | `/admin/content` | ✗ | ✓ | Update system content |
| GET | `/leadership/directory` | ✓ | ✓ | Leadership info |
| GET | `/ministries/list` | ✓ | ✓ | All ministries |

## 🔐 Security Considerations

### Authentication
- JWT tokens valid for 24 hours
- Passwords hashed with bcrypt (cost=11)
- Session-based support available

### Database
- All queries use PDO prepared statements
- Protection against SQL injection
- Foreign key constraints enabled

### API
- CORS configured for development
- Request validation on all endpoints
- Audit logging for sensitive actions
- Rate limiting (implement for production)

### Production Checklist
- [ ] Change database password
- [ ] Update JWT_SECRET
- [ ] Enable HTTPS
- [ ] Set APP_ENV to 'production'
- [ ] Configure proper error reporting
- [ ] Set up email notifications
- [ ] Implement rate limiting
- [ ] Regular database backups
- [ ] Monitor error logs

## 🐛 Troubleshooting

### "Connection refused" Error
**Solution:** Ensure MySQL is running in XAMPP Control Panel

### "Database not found" Error
**Solution:** Run setup.php again to create database

### "Access denied for user" Error
**Solution:** Check DB credentials in `config/Config.php`

### CORS Errors in Browser
**Solution:** Frontend and backend must be on allowed origins list

### 404 on API Endpoints
**Solution:** Ensure mod_rewrite is enabled in Apache
```
a2enmod rewrite
systemctl restart apache2
```

## 📝 File Structure

```
backend/
├── config/
│   ├── Config.php          # App configuration
│   └── Database.php        # PDO connection manager
├── api/
│   ├── auth/
│   │   ├── login.php
│   │   ├── register.php
│   │   └── logout.php
│   ├── members/
│   │   ├── list.php
│   │   ├── get.php
│   │   ├── approve.php
│   │   └── ...
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── content.php
│   │   └── ...
│   ├── leadership/
│   │   └── directory.php
│   └── ministries/
│       └── list.php
├── utils/
│   ├── Response.php        # JSON response handler
│   ├── Auth.php            # JWT & password handling
│   ├── Validator.php       # Input validation
│   └── Logger.php          # (future)
├── middleware/
│   ├── CORS.php            # Cross-origin handling
│   └── CheckAuth.php       # Authentication checks
├── database/
│   └── schema.sql          # Database structure
├── index.php               # Main API router
├── setup.php               # Database initialization
└── .htaccess               # Apache routing rules
```

## 📖 Documentation

- **API Documentation:** See `API_DOCUMENTATION.md`
- **Constitution:** Stored in project root
- **Leadership Manual:** Stored in project root

## 🔄 Development Workflow

1. **Make changes to React frontend**
2. **Test against local API**
3. **Commit to version control**
4. **Deploy backend to server**
5. **Deploy frontend to CDN/hosting**

## 📞 Support & Maintenance

- **Error Logs:** Check `apache_error.log` in XAMPP
- **Database Logs:** Monitor slow queries in MySQL
- **API Logs:** Audit trail in `audit_logs` table

## ✅ Verification Checklist

After setup, verify:

- [ ] Database created and populated
- [ ] Can access setup.php
- [ ] Can register a new member
- [ ] Can login with credentials
- [ ] JWT token is generated
- [ ] Can access protected endpoints with token
- [ ] Leadership directory displays correctly
- [ ] Admin dashboard shows statistics
- [ ] CORS allows frontend requests

## 🎉 You're Ready!

The MUTCU Digital Membership System is now set up and ready for development. 

**Next Steps:**
1. Create test users for different roles
2. Configure frontend environment variables
3. Implement frontend components to use API endpoints
4. Test end-to-end workflows
5. Plan deployment strategy

---

**Version:** 1.0  
**Last Updated:** April 10, 2026  
**Maintainer:** Development Team
