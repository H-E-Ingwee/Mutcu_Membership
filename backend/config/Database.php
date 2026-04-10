<?php
/**
 * Database Connection Manager
 * Uses PDO with prepared statements for security
 */

class Database {
    private static $instance = null;
    private $pdo;
    private $error;

    private function __construct() {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            die(json_encode(['error' => 'Database connection failed', 'message' => $this->error]));
        }
    }

    /**
     * Singleton pattern - get database instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get PDO connection
     */
    public function getConnection() {
        return $this->pdo;
    }

    /**
     * Execute prepared statement
     * @param string $sql SQL query with placeholders
     * @param array $params Parameters to bind
     * @return mixed Executed statement
     */
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    /**
     * Fetch single row
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch();
    }

    /**
     * Fetch multiple rows
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Insert record
     */
    public function insert($table, $data) {
        $columns = array_keys($data);
        $values = array_values($data);
        $placeholders = array_fill(0, count($data), '?');

        $sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
        
        $stmt = $this->execute($sql, $values);
        return $this->pdo->lastInsertId();
    }

    /**
     * Update record
     */
    public function update($table, $data, $where) {
        $set = array_keys($data);
        $values = array_values($data);

        foreach ($set as &$column) {
            $column = "$column = ?";
        }

        $sql = "UPDATE $table SET " . implode(',', $set);

        if (!empty($where)) {
            $whereConditions = [];
            foreach ($where as $column => $value) {
                $whereConditions[] = "$column = ?";
                $values[] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $whereConditions);
        }

        $stmt = $this->execute($sql, $values);
        return $stmt->rowCount();
    }

    /**
     * Delete record
     */
    public function delete($table, $where) {
        $whereConditions = [];
        $values = [];

        foreach ($where as $column => $value) {
            $whereConditions[] = "$column = ?";
            $values[] = $value;
        }

        $sql = "DELETE FROM $table WHERE " . implode(' AND ', $whereConditions);
        $stmt = $this->execute($sql, $values);
        return $stmt->rowCount();
    }

    /**
     * Begin transaction
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit() {
        return $this->pdo->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollback() {
        return $this->pdo->rollBack();
    }

    /**
     * Check if table exists
     */
    public function tableExists($tableName) {
        $sql = "SHOW TABLES LIKE ?";
        $result = $this->fetchOne($sql, [$tableName]);
        return $result !== false;
    }
}

?>
