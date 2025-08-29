<?php
require_once "database.php";

class Student extends Database
{
    private $table = "students";

    public function create($name, $email)
    {
        $sql = "INSERT INTO {$this->table} (name, email) VALUES (?, ?)";
        $this->runQuery($sql, [$name, $email]);
        return "Student added successfully.";
    }

    public function readAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->runQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function read($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->runQuery($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $name, $email)
    {
        $sql = "UPDATE {$this->table} SET name = ?, email = ? WHERE id = ?";
        $this->runQuery($sql, [$name, $email, $id]);
        return "Student updated successfully.";
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->runQuery($sql, [$id]);
        return "Student deleted successfully.";
    }

    public function readById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->runQuery($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
