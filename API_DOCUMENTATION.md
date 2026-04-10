# MUTCU Digital Membership System - API Documentation

**Version:** 1.0  
**Base URL:** `http://localhost/mutcu_membership/backend/api`  
**Environment:** Development

---

## 🔐 Authentication

All protected endpoints require a JWT token in the `Authorization` header:

```
Authorization: Bearer <JWT_TOKEN>
```

### Login
- **POST** `/auth/login`
- **Body:**
  ```json
  {
    "email": "user@example.com",
    "password": "Password123"
  }
  ```
- **Response:**
  ```json
  {
    "success": true,
    "message": "Login successful",
    "data": {
      "token": "eyJhbGc...",
      "user": {
        "id": 1,
        "firstName": "John",
        "lastName": "Doe",
        "email": "john@example.com",
        "role": "General Member",
        "status": "Active"
      }
    }
  }
  ```

### Register
- **POST** `/auth/register`
- **Body:**
  ```json
  {
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "phone": "0712345678",
    "registration_number": "SC200/0396/2022",
    "course": "BSc. Computer Science",
    "year_of_study": "3",
    "password": "Password123"
  }
  ```
- **Response:**
  ```json
  {
    "success": true,
    "message": "Registration successful. Awaiting admin approval.",
    "data": {
      "id": 5,
      "first_name": "John",
      "email": "john@example.com"
    }
  }
  ```
- **Status:** 201 Created

---

## 👥 Members Endpoints

### List Members (Admin Only)
- **GET** `/members/list?page=1&perPage=20&search=&status=Active`
- **Requires:** Admin role
- **Query Parameters:**
  - `page` (int): Page number (default: 1)
  - `perPage` (int): Records per page (default: 20)
  - `search` (string): Search by name, email, or reg number
  - `status` (string): Filter by status (Active, Pending, Inactive, Alumni)
- **Response:**
  ```json
  {
    "success": true,
    "message": "Members retrieved successfully",
    "data": [...],
    "pagination": {
      "total": 150,
      "page": 1,
      "perPage": 20,
      "totalPages": 8
    }
  }
  ```

### Get Member Details
- **GET** `/members/get?id=1`
- **Requires:** Authentication (can view own or admin can view any)
- **Query Parameters:**
  - `id` (int): Member ID (required)
- **Response:**
  ```json
  {
    "success": true,
    "data": {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john@example.com",
      "phone": "0712345678",
      "registration_number": "SC200/0396/2022",
      "course_of_study": "BSc. Computer Science",
      "year_of_study": "Year 3 (Endelea 2)",
      "status": "Active",
      "membership_type": "Full",
      "avatar_url": "...",
      "ministries": [
        {
          "id": 3,
          "name": "Music Committee",
          "role_name": "General Member",
          "is_primary_ministry": true
        }
      ]
    }
  }
  ```

### Approve Member Registration (Admin Only)
- **POST** `/members/approve`
- **Requires:** Admin role
- **Body:**
  ```json
  {
    "member_id": 5
  }
  ```
- **Response:**
  ```json
  {
    "success": true,
    "message": "Member approved successfully",
    "data": {
      "id": 5,
      "status": "Active"
    }
  }
  ```

---

## 📊 Admin Dashboard

### Dashboard Analytics
- **GET** `/admin/dashboard`
- **Requires:** Admin role
- **Response:**
  ```json
  {
    "success": true,
    "data": {
      "statistics": {
        "totalMembers": 245,
        "activeMembers": 230,
        "pendingApprovals": 12,
        "firstYearStudents": 45
      },
      "membersByMinistry": [
        {
          "name": "Prayer Committee",
          "count": 78
        },
        {
          "name": "Music Committee",
          "count": 56
        }
      ],
      "membersByYear": [
        {
          "display_name": "Year 1 (Anza FYT)",
          "count": 45
        }
      ],
      "pendingRegistrations": [...]
    }
  }
  ```

### Content Management
- **GET** `/admin/content` - Retrieve all system content
- **POST** `/admin/content` - Update/create content
- **Requires:** Admin role
- **Body (POST):**
  ```json
  {
    "content_key": "constitution_awareness",
    "content_title": "Constitution & Awareness",
    "content_text": "As a member of MUTCU...",
    "is_published": true
  }
  ```

---

## 👑 Leadership

### Leadership Directory (Public)
- **GET** `/leadership/directory`
- **No Authentication Required**
- **Response:**
  ```json
  {
    "success": true,
    "data": {
      "executiveCouncil": [
        {
          "first_name": "Sarah",
          "last_name": "Wanjiku",
          "email": "sarah@example.com",
          "phone": "0723456789",
          "role_name": "Chairperson",
          "ministry": "Executive Council"
        }
      ],
      "ministryCoordinators": [...]
    }
  }
  ```

---

## 🎵 Ministries

### List Ministries
- **GET** `/ministries/list`
- **No Authentication Required**
- **Response:**
  ```json
  {
    "success": true,
    "data": [
      {
        "id": 1,
        "name": "Prayer Committee",
        "description": "Mobilizes and leads consistent, fervent prayer",
        "coordinator": {
          "first_name": "John",
          "last_name": "Doe",
          "email": "john@example.com"
        },
        "member_count": 78
      }
    ]
  }
  ```

---

## 🔑 Response Format

### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": {}
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field_name": "Field-specific error"
  }
}
```

### HTTP Status Codes
- `200` - OK
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Failed
- `500` - Server Error

---

## 🛡️ Security

1. **Password Requirements:**
   - Minimum 8 characters
   - At least one uppercase letter
   - At least one lowercase letter
   - At least one number

2. **Hashing:** All passwords are hashed using bcrypt (cost=11)

3. **SQL Protection:** All queries use PDO prepared statements

4. **JWT Tokens:** 24-hour validity, renewable on each login

5. **CORS:** Configured for development environment

---

## 📋 Required Environment Setup

1. **Database:** MySQL/MariaDB with `mutcu_membership` database
2. **PHP:** Version 8.0 or higher
3. **Extensions:** PDO MySQL
4. **Web Server:** Apache with mod_rewrite enabled

---

## 🚀 Getting Started

1. **Run database setup:**
   ```
   http://localhost/mutcu_membership/backend/setup.php
   ```

2. **Register a new member:**
   ```bash
   POST /api/auth/register
   ```

3. **Login:**
   ```bash
   POST /api/auth/login
   ```

4. **Use token for authenticated requests:**
   ```
   Authorization: Bearer <your_token>
   ```

---

## 📝 Notes

- All timestamps are in UTC/Nairobi timezone
- Phone numbers must be in Kenya format (0712345678 or +254712345678)
- Registration numbers follow pattern: XX000/0000/0000
- Ministry assignments require admin approval
- Discipline actions are logged for audit trail

---

**Last Updated:** April 10, 2026  
**Next Version:** 2.0 (Scheduled with mobile app integration)
