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
    public function showCategoriesOrder($selectedId)
    {
        global $conn;
        $stmt = $conn->query("SELECT ID, categoryName from category WHERE menuID = $selectedId", PDO::FETCH_ASSOC);
        foreach ($stmt as $data) {

                $categoryID = $data['ID'];
                $categoryName = $data['categoryName'];
                echo $categoryID." ".$categoryName."<br>";
        }
        
    }
    public function rearrangeCategoriesOrder($selectedId)
    {
        global $conn;
        $stmt = $conn->query("SELECT ID, categoryName from category WHERE menuID = $selectedId", PDO::FETCH_ASSOC);
        foreach ($stmt as $data) {

                $categoryID = $data['ID'];
                $categoryName = $data['categoryName'];
                echo $categoryID." ".$categoryName."<br>";
        }
        
    }
}