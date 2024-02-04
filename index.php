<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Todo List</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">
        <i class="fas fa-list-check"></i> Todo List
    </h2>
    <form id="addTodoForm">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="task" placeholder="Add a new task" required>
            
            <!-- Add priority dropdown -->
            <select class="form-select" id="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <button class="btn btn-primary" type="submit">
                <i class="fas fa-plus"></i> Add
            </button>

            <div class="input-group mb-3">
                <label for="dueDate" class="input-group-text">
                    <i class="far fa-calendar-alt"></i> Due Date
                </label>
                <input type="date" class="form-control" id="dueDate">
            </div>
        </div>
    </form>
    <ul id="todo-list" class="list-group"></ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
