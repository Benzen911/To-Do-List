<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['task_name'])) {
    $stmt = $conn->prepare("INSERT INTO tasks (task_name) VALUES (:task_name)");
    $stmt->bindParam(':task_name', $_POST['task_name']);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>