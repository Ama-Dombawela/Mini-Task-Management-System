<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$message = trim($_GET['msg'] ?? '');
$messageType = trim($_GET['type'] ?? 'info');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
	// Handle the task create form submission.
	$title = sanitize($_POST['title'] ?? '');
	$description = sanitize($_POST['description'] ?? '');
	$priority = sanitize($_POST['priority'] ?? '');

	if ($title === '') {
		header('Location: add-task.php?msg=' . urlencode('Title is required.') . '&type=danger');
		exit();
	}
	if (strlen($title) < 3) {
		header('Location: add-task.php?msg=' . urlencode('Title must be at least 3 characters.') . '&type=danger');
		exit();
	}
	if (!in_array($priority, ['Low', 'Medium', 'High'], true)) {
		header('Location: add-task.php?msg=' . urlencode('Invalid priority.') . '&type=danger');
		exit();
	}

	$sql = $conn->prepare('INSERT INTO tasks (title, description, priority) VALUES (?, ?, ?)');
	if (!$sql) {
		header('Location: add-task.php?msg=' . urlencode('Failed to prepare statement.') . '&type=danger');
		exit();
	}

	$sql->bind_param('sss', $title, $description, $priority);
	if ($sql->execute()) {
		$sql->close();
		header('Location: view-task.php?msg=' . urlencode('Task added successfully!') . '&type=success');
		exit();
	}

	$sql->close();
	header('Location: add-task.php?msg=' . urlencode('Failed to add task.') . '&type=danger');
	exit();
}

require_once '../includes/header.php';
?>

<div class="row justify-content-center">
	<div class="col-12 col-lg-8 col-xl-7">
		<div class="content-panel">
			<div class="mb-4">
				<p class="text-uppercase text-muted fw-semibold mb-1">Create task</p>
				<h1 class="h3 mb-0">Add Task</h1>
			</div>

			<?php if ($message !== ''): ?>
				<div class="alert alert-<?php echo htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<form method="post" action="add-task.php" class="task-form">
				<div class="mb-3">
					<label class="form-label" for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" required>
				</div>
				<div class="mb-3">
					<label class="form-label" for="description">Description</label>
					<textarea class="form-control" id="description" name="description" rows="4"></textarea>
				</div>
				<div class="mb-4">
					<label class="form-label" for="priority">Priority</label>
					<select class="form-select" id="priority" name="priority" required>
						<option value="">Select priority</option>
						<option value="Low">Low</option>
						<option value="Medium">Medium</option>
						<option value="High">High</option>
					</select>
				</div>
				<div class="d-flex gap-2">
					<button type="submit" class="btn btn-primary">Save Task</button>
					<a class="btn btn-outline-secondary" href="view-task.php">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once '../includes/footer.php'; ?>