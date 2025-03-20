<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = (int) $_GET['id']; // Ensure it's an integer

    try {
        $stmt = $conn->prepare("UPDATE tasks SET is_completed = 1 WHERE id = ?");
        $stmt->execute([$task_id]);

        // Redirect back to index.php after marking complete
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error updating task: " . $e->getMessage());
    }
} else {
    die("Invalid request: Task ID missing or invalid.");
}
?>