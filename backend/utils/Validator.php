<?php
/**
 * Input Validator Class
 */

class Validator {
    private $errors = [];

    /**
     * Validate email
     */
    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
            return false;
        }
        return true;
    }

    /**
     * Validate password strength
     */
    public function validatePassword($password) {
        if (strlen($password) < 8) {
            $this->errors['password'] = 'Password must be at least 8 characters long';
            return false;
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $this->errors['password'] = 'Password must contain at least one uppercase letter';
            return false;
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $this->errors['password'] = 'Password must contain at least one lowercase letter';
            return false;
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $this->errors['password'] = 'Password must contain at least one number';
            return false;
        }
        
        return true;
    }

    /**
     * Validate registration number format
     */
    public function validateRegistrationNumber($regNo) {
        // Format: SC200/0396/2022 or similar
        if (!preg_match('/^[A-Z]{2,4}\d{3}\/\d{4}\/\d{4}$/', $regNo)) {
            $this->errors['registration_number'] = 'Invalid registration number format';
            return false;
        }
        return true;
    }

    /**
     * Validate phone number
     */
    public function validatePhoneNumber($phone) {
        // Kenya phone format: 0712345678 or +254712345678
        if (!preg_match('/^(\+254|0)[712]\d{8}$/', $phone)) {
            $this->errors['phone'] = 'Invalid phone number format. Use Kenya format (0712345678)';
            return false;
        }
        return true;
    }

    /**
     * Validate required field
     */
    public function validateRequired($value, $fieldName) {
        if (empty($value)) {
            $this->errors[$fieldName] = ucfirst($fieldName) . ' is required';
            return false;
        }
        return true;
    }

    /**
     * Validate minimum length
     */
    public function validateMinLength($value, $minLength, $fieldName) {
        if (strlen($value) < $minLength) {
            $this->errors[$fieldName] = ucfirst($fieldName) . ' must be at least ' . $minLength . ' characters';
            return false;
        }
        return true;
    }

    /**
     * Validate maximum length
     */
    public function validateMaxLength($value, $maxLength, $fieldName) {
        if (strlen($value) > $maxLength) {
            $this->errors[$fieldName] = ucfirst($fieldName) . ' must not exceed ' . $maxLength . ' characters';
            return false;
        }
        return true;
    }

    /**
     * Validate year of study
     */
    public function validateYearOfStudy($year) {
        $validYears = ['1', '2', '3', '4', '5', 'Alumni'];
        if (!in_array($year, $validYears)) {
            $this->errors['year_of_study'] = 'Invalid year of study';
            return false;
        }
        return true;
    }

    /**
     * Get all errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Check if validation passed
     */
    public function passes() {
        return empty($this->errors);
    }

    /**
     * Clear errors
     */
    public function clearErrors() {
        $this->errors = [];
    }

    /**
     * Sanitize string input
     */
    public static function sanitizeString($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize email
     */
    public static function sanitizeEmail($email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Get JSON request body
     */
    public static function getJSONInput() {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }
}

?>
