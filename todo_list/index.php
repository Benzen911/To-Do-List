<?php
require 'db.php';

$stmt = $conn->query("SELECT * FROM tasks WHERE is_completed = 0 ORDER BY created_at DESC");
$pendingTasks = $stmt->fetchAll();

$stmt = $conn->query("SELECT * FROM tasks WHERE is_completed = 1 ORDER BY created_at DESC");
$completedTasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 to-do-title">📋 To-Do List</h2>
                <button class="btn btn-dark" id="darkModeToggle">🌙</button>
            </div>
            
            <form action="add_task.php" method="POST" class="d-flex mt-3">
                <input type="text" name="task_name" class="form-control me-2" placeholder="Enter new task" required>
                <button type="submit" class="btn btn-success">➕ Add Task</button>
            </form>

            <h4 class="text-primary mt-4">📝 Pending Tasks</h4>
            <ul class="list-group mb-4">
                <?php if (count($pendingTasks) == 0): ?>
                    <li class="list-group-item text-muted">No pending tasks.</li>
                <?php endif; ?>
                <?php foreach ($pendingTasks as $task): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo htmlspecialchars($task['task_name']); ?>
                        <div>
                            <a href="complete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-success btn-sm complete-btn">✔ Complete</a>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm delete-btn">✖ Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h4 class="text-success">✔ Completed Tasks</h4>
            <ul class="list-group">
                <?php if (count($completedTasks) == 0): ?>
                    <li class="list-group-item text-muted">No completed tasks.</li>
                <?php endif; ?>
                <?php foreach ($completedTasks as $task): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light text-muted">
                        <s><?php echo htmlspecialchars($task['task_name']); ?></s>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm delete-btn">✖ Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const darkModeToggle = document.getElementById('darkModeToggle');

            // Check localStorage for dark mode preference
            if (localStorage.getItem('dark-mode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }

            // Toggle Dark Mode and Save Preference
            darkModeToggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('dark-mode', 'enabled');
                } else {
                    localStorage.setItem('dark-mode', 'disabled');
                }
            });
        });
    </script>

</body>
</html>
