$(document).ready(function () {
    // Load initial todo list
    loadTodoList();

    // Add or edit todo item
    $('#addTodoForm').submit(function (e) {
        e.preventDefault();
        var task = $('#task').val();
        var priority = $('#priority').val();
        var dueDate = $('#dueDate').val();
        var id = $('#task').data('id');

        if (id) {
            editTodoItem(id, task, priority, dueDate);
        } else {
            addTodoItem(task, priority, dueDate);
        }
    });

    // Edit todo item
    $('#todo-list').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        var taskText = $(this).closest('li').find('.task-text').text();
        var priority = $(this).closest('li').find('.priority-text').text();
        var dueDate = $(this).closest('li').find('.due-date-text').text();

        $('#task').val(taskText).data('id', id);
        $('#priority').val(priority);
        $('#dueDate').val(dueDate);
    });

    // Delete todo item
    $('#todo-list').on('click', '.deleteBtn', function () {
        var id = $(this).data('id');
        showDeleteConfirmation(id);
    });

    // Load todo list
    function loadTodoList() {
        $.ajax({
            url: 'todo.php',
            method: 'GET',
            success: function (data) {
                $('#todo-list').html(data);
            }
        });
    }

    // Add or edit todo item
    function addTodoItem(task, priority, dueDate) {
        $.ajax({
            url: 'todo.php',
            method: 'POST',
            data: { task: task, priority: priority, due_date: dueDate },
            success: function () {
                loadTodoList();
                $('#task').val('').removeData('id');
                $('#priority').val('low');
                $('#dueDate').val('');
            }
        });
    }

    // Edit todo item
    function editTodoItem(id, task, priority, dueDate) {
        $.ajax({
            url: 'todo.php',
            method: 'POST',
            data: { id: id, task: task, priority: priority, due_date: dueDate, action: 'edit' },
            success: function () {
                loadTodoList();
                $('#task').val('').removeData('id');
                $('#priority').val('low');
                $('#dueDate').val('');
            }
        });
    }

    // Delete todo item with confirmation
    function showDeleteConfirmation(id) {
        var confirmation = confirm('Are you sure you want to delete this todo item?');

        if (confirmation) {
            deleteTodoItem(id);
        }
    }

    // Delete todo item
    function deleteTodoItem(id) {
        $.ajax({
            url: 'todo.php',
            method: 'POST',
            data: { id: id, action: 'delete' },
            success: function () {
                loadTodoList();
            }
        });
    }
});
