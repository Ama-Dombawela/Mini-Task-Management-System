<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
	// Delete the selected task.
	$sql = $conn->prepare('DELETE FROM tasks WHERE id = ?');
	if ($sql) {
		$sql->bind_param('i', $id);
		if ($sql->execute()) {
			$sql->close();
			header('Location: view-task.php?msg=' . urlencode('Task deleted successfully.') . '&type=success');
			exit();
		}
		$sql->close();
	}

	header('Location: view-task.php?msg=' . urlencode('Failed to delete task.') . '&type=danger');
	exit();
}

require_once '../includes/header.php';
$message = trim($_GET['msg'] ?? '');
$messageType = trim($_GET['type'] ?? 'info');


// Load tasks for the delete list.
$tasks = getAllTasks($conn);
?>

<div class="row justify-content-center">
	<div class="col-12 col-xl-10">
		<div class="content-panel">
			<div class="mb-4">
				<p class="text-uppercase text-muted fw-semibold mb-1">Delete tasks</p>
				<h1 class="h3 mb-0">Delete Task</h1>
			</div>

			<?php if ($message !== ''): ?>
				<div class="alert alert-<?php echo htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<div class="table-wrap">
				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead>
							<tr>
								<th>Title</th>
								<th>Status</th>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($tasks && $tasks->num_rows > 0): ?>
								<?php while ($task = $tasks->fetch_assoc()): ?>
									<tr>
										<td class="fw-semibold"><?php echo htmlspecialchars($task['title'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><span class="badge <?php echo statusBadge($task['status']); ?>"><?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></span></td>
										<td class="text-end">
											<a class="btn btn-sm btn-danger" href="delete-task.php?id=<?php echo (int) $task['id']; ?>" onclick="return confirm('Delete this task?');">Delete</a>
										</td>
									</tr>
								<?php endwhile; ?>
							<?php else: ?>
								<tr><td colspan="3" class="text-center text-muted py-5">No tasks available.</td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once '../includes/footer.php'; ?>
