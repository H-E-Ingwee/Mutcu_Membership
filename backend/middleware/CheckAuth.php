<?php
/**
 * Authentication Middleware
 * Checks if user is authenticated
 */

class CheckAuth {
    /**
     * Require authentication
     */
    public static function required() {
        if (!Auth::isAuthenticated()) {
            Response::unauthorized('Authentication required. Please login.');
        }
    }

    /**
     * Require admin role
     */
    public static function requireAdmin() {
        self::required();
        
        $user = Auth::getCurrentUser();
        
        if ($user['role'] !== 'Administrator') {
            Response::forbidden('Administrator access required.');
        }
    }

    /**
     * Require specific role
     */
    public static function requireRole($role) {
        self::required();
        
        if (!Auth::hasRole($role)) {
            Response::forbidden('Insufficient permissions for this action.');
        }
    }

    /**
     * Check if user owns resource
     */
    public static function checkOwnership($userId) {
        self::required();
        
        $user = Auth::getCurrentUser();
        
        // Admin can access anything, but user can only access their own
        if ($user['role'] !== 'Administrator' && $user['userId'] !== $userId) {
            Response::forbidden('You do not have permission to access this resource.');
        }
    }
}

?>
