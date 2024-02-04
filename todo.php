<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtodo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create todo table if not exists
$sql = "CREATE TABLE IF NOT EXISTS todos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(255) NOT NULL,
        priority VARCHAR(10) NOT NULL,
        create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        due_date DATE
        )";

$conn->query($sql);

// CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch and display todo list
    $result = $conn->query("SELECT * FROM todos");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="task-text">' . $row['task'] . '</span>
                    <span class="priority-text badge bg-' . getPriorityColor($row['priority']) . '">' . $row['priority'] . '</span>
                    <span class="due-date-text">' . ($row['due_date'] ? date('M d, Y', strtotime($row['due_date'])) : '') . '</span>
                    <div class="btn-group" role="group">
                        <button class="btn btn-warning editBtn" data-id="' . $row['id'] . '">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger deleteBtn" data-id="' . $row['id'] . '">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </li>';
        }
    } else {
        echo '<li class="list-group-item">No tasks found</li>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add, edit, or delete todo item
    if ($_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $conn->query("DELETE FROM todos WHERE id = $id");
    } else {
        $task = $_POST['task'];
        $priority = $_POST['priority'];
        $dueDate = $_POST['due_date'];
        $id = $_POST['id'];

        if ($_POST['action'] === 'edit') {
            $conn->query("UPDATE todos SET task = '$task', priority = '$priority', due_date = '$dueDate' WHERE id = $id");
        } else {
            $conn->query("INSERT INTO todos (task, priority, due_date) VALUES ('$task', '$priority', '$dueDate')");
        }
    }
}

$conn->close();

// Function to get priority color
function getPriorityColor($priority)
{
    switch ($priority) {
        case 'low':
            return 'success'; // Green
        case 'medium':
            return 'warning'; // Yellow
        case 'high':
            return 'danger'; // Red
        default:
            return 'secondary'; // Default color
    }
}
?>
