<?php
/**
 * Authentication Helper Class
 */

class Auth {
    /**
     * Hash password using bcrypt
     */
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_HASH_ALGO, PASSWORD_HASH_OPTIONS);
    }

    /**
     * Verify password against hash
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Generate JWT token
     */
    public static function generateToken($userId, $email, $role = 'General Member') {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'iat' => time(),
            'exp' => time() + (24 * 60 * 60), // 24 hours
            'userId' => $userId,
            'email' => $email,
            'role' => $role
        ]);

        $base64UrlHeader = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, JWT_SECRET, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
    }

    /**
     * Verify JWT token
     */
    public static function verifyToken($token) {
        $parts = explode('.', $token);
        
        if (count($parts) !== 3) {
            return false;
        }

        $header = $parts[0];
        $payload = $parts[1];
        $signature = $parts[2];

        $valid_signature = rtrim(strtr(base64_encode(hash_hmac('sha256', $header . '.' . $payload, JWT_SECRET, true)), '+/', '-_'), '=');

        if ($signature !== $valid_signature) {
            return false;
        }

        $decoded = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

        if ($decoded['exp'] < time()) {
            return false;
        }

        return $decoded;
    }

    /**
     * Get token from request headers
     */
    public static function getTokenFromRequest() {
        $headers = getallheaders();
        
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s+([^\s]+)/', $authHeader, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Get current user from token
     */
    public static function getCurrentUser() {
        $token = self::getTokenFromRequest();
        
        if (!$token) {
            return null;
        }

        return self::verifyToken($token);
    }

    /**
     * Generate random token for password reset
     */
    public static function generateResetToken($length = 32) {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Check if user is authenticated
     */
    public static function isAuthenticated() {
        return self::getCurrentUser() !== null && self::getCurrentUser() !== false;
    }

    /**
     * Check if user has specific role
     */
    public static function hasRole($requiredRole) {
        $user = self::getCurrentUser();
        
        if (!$user) {
            return false;
        }

        return $user['role'] === $requiredRole || $user['role'] === 'Administrator';
    }
}

?>
