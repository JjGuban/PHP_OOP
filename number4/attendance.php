<?php
require_once "database.php";

class Attendance extends Database
{
    public function create($student_id, $date, $status)
    {
        $sql = "INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)";
        $this->runQuery($sql, [$student_id, $date, $status]);
        return "Attendance recorded!";
    }

    public function readAll()
    {
        $sql = "SELECT a.id, s.name, s.email, a.date, a.status 
                FROM attendance a 
                JOIN students s ON a.student_id = s.id";
        return $this->runQuery($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($id)
    {
        $sql = "SELECT * FROM attendance WHERE id = ?";
        return $this->runQuery($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $status)
    {
        $sql = "UPDATE attendance SET status = ? WHERE id = ?";
        $this->runQuery($sql, [$status, $id]);
        return "Attendance updated!";
    }

    public function delete($id)
    {
        $sql = "DELETE FROM attendance WHERE id = ?";
        $this->runQuery($sql, [$id]);
        return "Attendance deleted!";
    }
}