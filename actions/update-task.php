<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
	// Toggle the selected task status.
	$task = getTaskById($conn, $id);
	if (!$task) {
		header('Location: view-task.php?msg=' . urlencode('Task not found.') . '&type=danger');
		exit();
	}

	$newStatus = ($task['status'] === 'Completed') ? 'Pending' : 'Completed';
	$sql = $conn->prepare('UPDATE tasks SET status = ? WHERE id = ?');
	if ($sql) {
		$sql->bind_param('si', $newStatus, $id);
		if ($sql->execute()) {
			$sql->close();
			header('Location: view-task.php?msg=' . urlencode('Status updated to ' . $newStatus . '.') . '&type=success');
			exit();
		}
		$sql->close();
	}

	header('Location: view-task.php?msg=' . urlencode('Failed to update task.') . '&type=danger');
	exit();
}

require_once '../includes/header.php';
$message = trim($_GET['msg'] ?? '');
$messageType = trim($_GET['type'] ?? 'info');

// Load tasks for the update list.
$tasks = getAllTasks($conn);
?>

<div class="row justify-content-center">
	<div class="col-12 col-xl-10">
		<div class="content-panel">
			<div class="mb-4">
				<p class="text-uppercase text-muted fw-semibold mb-1">Update tasks</p>
				<h1 class="h3 mb-0">Update Task</h1>
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
											<a class="btn btn-sm btn-warning" href="update-task.php?id=<?php echo (int) $task['id']; ?>">Toggle Status</a>
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
