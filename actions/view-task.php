<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/header.php';

$message = trim($_GET['msg'] ?? '');
$messageType = trim($_GET['type'] ?? 'info');

// Load tasks for the main listing.
$tasks = getAllTasks($conn);
?>

<div class="row justify-content-center">
	<div class="col-12 col-xl-11">
		<div class="content-panel">
			<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
				<div>
					<p class="text-uppercase text-muted fw-semibold mb-1">Task list</p>
					<h1 class="h3 mb-0">View Tasks</h1>
				</div>
				<div class="d-flex gap-2">
					<a class="btn btn-primary" href="add-task.php">Add Task</a>
				</div>
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
								<th>Description</th>
								<th>Priority</th>
								<th>Status</th>
								<th>Created</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($tasks && $tasks->num_rows > 0): ?>
								<?php while ($task = $tasks->fetch_assoc()): ?>
									<tr>
										<td class="fw-semibold"><?php echo htmlspecialchars($task['title'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><span class="badge <?php echo priorityBadge($task['priority']); ?>"><?php echo htmlspecialchars($task['priority'], ENT_QUOTES, 'UTF-8'); ?></span></td>
										<td><span class="badge <?php echo statusBadge($task['status']); ?>"><?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></span></td>
										<td><?php echo htmlspecialchars($task['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
								<?php endwhile; ?>
							<?php else: ?>
								<tr>
									<td colspan="5" class="text-center text-muted py-5">No tasks found yet.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once '../includes/footer.php'; ?>