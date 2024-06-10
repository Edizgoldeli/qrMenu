<?php
class Sql
{
    private $selectedId;

    public function updateStatus($selectedId)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE menu SET status = 1 WHERE id = :selectedId");
        $stmt->bindParam(':selectedId', $selectedId, PDO::PARAM_INT);
        $stmt->execute();
    
        // Set the rest of the statuses to 0
        $stmt = $conn->prepare("UPDATE menu SET status = 0 WHERE id != :selectedId");
        $stmt->bindParam(':selectedId', $selectedId, PDO::PARAM_INT);
        $stmt->execute();
    }
}