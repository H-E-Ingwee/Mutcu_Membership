# MUTCU API Quick Reference Card

## 🔑 Authentication Endpoints

```
POST /auth/login
├─ Body: { email, password }
├─ Returns: { token, user }
└─ Status: 200

POST /auth/register
├─ Body: { first_name, last_name, email, phone, registration_number, course, year_of_study, password }
├─ Returns: { id, first_name, email }
└─ Status: 201
```

## 👥 Member Endpoints

```
GET /members/list
├─ Query: ?page=1&perPage=20&search=&status=Active
├─ Requires: Admin
└─ Returns: Paginated member list

GET /members/get?id={id}
├─ Query: ?id={userId}
├─ Returns: Member details + ministries
└─ Auth: Own profile or Admin

POST /members/update
├─ Body: { id, phone, course, year_of_study }
└─ Returns: { id }

POST /members/approve
├─ Body: { member_id }
├─ Requires: Admin
└─ Returns: { id, status }
```

## 📊 Admin Endpoints

```
GET /admin/dashboard
├─ Requires: Admin
└─ Returns: Statistics, ministries breakdown, pending approvals

GET /admin/directory
├─ Requires: Admin
└─ Returns: All members with filters

POST /admin/content
├─ Method: GET (read) or POST (update)
├─ Requires: Admin
└─ Body: { content_key, content_title, content_text, is_published }
```

## 👑 Leadership Endpoints

```
GET /leadership/directory
├─ Public: Yes
└─ Returns: Executive Council + Ministry Coordinators
```

## 🎵 Ministry Endpoints

```
GET /ministries/list
├─ Public: Yes
└─ Returns: All ministries with coordinator info

GET /ministries/members?id={id}
├─ Query: ?id={ministryId}
├─ Public: Yes
└─ Returns: Ministry details + members
```

## 📋 Standard Response Format

### Success (200, 201)
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { /* payload */ }
}
```

### Paginated (200)
```json
{
  "success": true,
  "message": "...",
  "data": [...],
  "pagination": {
    "total": 150,
    "page": 1,
    "perPage": 20,
    "totalPages": 8
  }
}
```

### Error (4xx, 5xx)
```json
{
  "success": false,
  "message": "Error description",
  "errors": { "field": "error message" }
}
```

## 🔐 Authentication Header

```
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

## 📊 Status Codes

| Code | Meaning | Example |
|------|---------|---------|
| 200 | OK | GET request succeeded |
| 201 | Created | Resource created |
| 400 | Bad Request | Missing required field |
| 401 | Unauthorized | No/invalid token |
| 403 | Forbidden | Insufficient permissions |
| 404 | Not Found | Resource doesn't exist |
| 422 | Validation Error | Invalid input |
| 500 | Server Error | Unexpected error |

## 🎯 Common Workflows

### 1. Register & Login
```
POST /auth/register  →  Get registration pending
POST /admin → Approve member (as admin)
POST /auth/login  →  Get JWT token
GET /members/get?id=X  →  View profile
```

### 2. Admin Dashboard
```
GET /admin/dashboard  →  View analytics
GET /members/list  →  View all members
POST /members/approve  →  Approve pending
POST /admin/content  →  Update content
```

### 3. Public Access
```
GET /leadership/directory  →  View leaders
GET /ministries/list  →  View all ministries
GET /ministries/members?id=X  →  View ministry
```

## ⚙️ Configuration

| Variable | Location | Value |
|----------|----------|-------|
| Base URL | Frontend .env | http://localhost/mutcu_membership/backend/api |
| DB Host | Config.php | localhost |
| DB User | Config.php | root |
| DB Password | Config.php | (empty for XAMPP) |
| DB Name | Config.php | mutcu_membership |
| JWT Secret | Config.php | mutcu_secret_key_2025_... |

## 🚀 Getting Started

1. **Setup Database**
   ```
   http://localhost/mutcu_membership/backend/setup.php
   ```

2. **Register User**
   ```bash
   POST /api/auth/register
   ```

3. **Login**
   ```bash
   POST /api/auth/login
   ```

4. **Use Token**
   ```
   Authorization: Bearer {token}
   ```

## 📱 Frontend Integration

```javascript
// API Client Helper
const API_BASE = import.meta.env.VITE_API_BASE_URL || 'http://localhost/mutcu_membership/backend/api';

async function apiCall(endpoint, options = {}) {
  const token = localStorage.getItem('token');
  const headers = {
    'Content-Type': 'application/json',
    ...(token && { 'Authorization': `Bearer ${token}` })
  };
  
  const response = await fetch(`${API_BASE}${endpoint}`, {
    ...options,
    headers: { ...headers, ...options.headers }
  });
  
  return response.json();
}

// Usage
const user = await apiCall('/auth/login', {
  method: 'POST',
  body: JSON.stringify({ email: 'user@example.com', password: 'pass' })
});
```

---

**Print this card for quick reference while developing!**
