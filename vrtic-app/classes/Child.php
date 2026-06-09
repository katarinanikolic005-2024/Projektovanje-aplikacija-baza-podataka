<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/CrudInterface.php';

class Child implements CrudInterface {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO children (full_name, birth_date, parent_phone, group_name, notes) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", 
            $data['full_name'], 
            $data['birth_date'], 
            $data['parent_phone'], 
            $data['group_name'], 
            $data['notes']
        );
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id !== null) {
            $sql = "SELECT * FROM children WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
        } else {
            $sql = "SELECT * FROM children ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update($id, $data) {
        $sql = "UPDATE children SET full_name=?, birth_date=?, parent_phone=?, group_name=?, notes=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", 
            $data['full_name'], 
            $data['birth_date'], 
            $data['parent_phone'], 
            $data['group_name'], 
            $data['notes'], 
            $id
        );
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM children WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>