<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$task_id]);

        // Redirect back to index.php after deleting
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error deleting task: " . $e->getMessage());
    }
} else {
    die("Invalid request: Task ID missing.");
}
?>

<?php
require 'db.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>