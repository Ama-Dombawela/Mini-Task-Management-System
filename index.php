<?php

require_once __DIR__ . "/includes/header.php";

?>

<div class="container mt-5">

    <div class="hero-banner mb-4">
        <p class="text-uppercase text-muted fw-semibold mb-2">Task overview</p>
        <h1 class="display-6 fw-bold mb-2">Mini Task Management System</h1>
        <p class="mb-0 text-secondary">Use the quick actions below to manage tasks from one place.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card task-card task-card-success h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h2 class="h4 card-title">View Tasks</h2>
                    <p class="card-text flex-grow-1">See every task in one place with status and priority.</p>
                    <a href="/Mini_Task_Management_System/actions/view-task.php" class="btn btn-light mt-2">View tasks</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card task-card task-card-primary h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h2 class="h4 card-title">Add Task</h2>
                    <p class="card-text flex-grow-1">Create a new task with a title, description, and priority.</p>
                    <a href="/Mini_Task_Management_System/actions/add-task.php" class="btn btn-light mt-2">Open form</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card task-card task-card-warning h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h2 class="h4 card-title">Update Task</h2>
                    <p class="card-text flex-grow-1">Switch task status between pending and completed.</p>
                    <a href="/Mini_Task_Management_System/actions/update-task.php" class="btn btn-light mt-2">Update status</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card task-card task-card-danger h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h2 class="h4 card-title">Delete Task</h2>
                    <p class="card-text flex-grow-1">Delete tasks you no longer need from the database.</p>
                    <a href="/Mini_Task_Management_System/actions/delete-task.php" class="btn btn-light mt-2">Delete task</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

require_once __DIR__ . "/includes/footer.php";

?>