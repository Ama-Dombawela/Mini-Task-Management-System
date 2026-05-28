
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Task Management System</title>
    <link href="/Mini_Task_Management_System/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Mini_Task_Management_System/css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Mini_Task_Management_System/index.php">Mini Task</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse gap-3" id="mainNavbar">
            <ul class="navbar-nav mx-auto flex-lg-row gap-lg-3">
                <li class="nav-item"><a class="nav-link" href="/Mini_Task_Management_System/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/Mini_Task_Management_System/actions/view-task.php">View Task</a></li>
                <li class="nav-item"><a class="nav-link" href="/Mini_Task_Management_System/actions/add-task.php">Add Task</a></li>
                <li class="nav-item"><a class="nav-link" href="/Mini_Task_Management_System/actions/update-task.php">Update Task</a></li>
                <li class="nav-item"><a class="nav-link" href="/Mini_Task_Management_System/actions/delete-task.php">Delete Task</a></li>
            </ul>
            <form class="d-flex search-form ms-lg-auto" action="/Mini_Task_Management_System/actions/search-tasks.php" method="get" role="search">
                <input class="form-control form-control-sm me-2 search-input" type="search" name="q" placeholder="Search tasks" aria-label="Search tasks">
                <button class="btn btn-outline-light btn-sm" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<main class="container mt-4 flex-grow-1">