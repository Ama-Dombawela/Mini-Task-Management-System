<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/header.php';

$query = trim($_GET['q'] ?? '');
$tasks = [];
$message = '';
$messageType = 'info';

if ($query === '') {
	// Show the search prompt when no query is sent.
	$message = 'Enter a task title to search.';
} else {
	$sql = $conn->prepare('SELECT id, title, description, priority, status, created_at FROM tasks WHERE title LIKE ? OR description LIKE ? ORDER BY created_at DESC');
	if ($sql) {
		$searchTerm = '%' . $query . '%';
		$sql->bind_param('ss', $searchTerm, $searchTerm);
		$sql->execute();
		$result = $sql->get_result();
		while ($row = $result->fetch_assoc()) {
			$tasks[] = $row;
		}
		$sql->close();

		if (!$tasks) {
			$message = 'No tasks matched your search.';
			$messageType = 'warning';
		}
	} else {
		$message = 'Unable to prepare the search query.';
		$messageType = 'danger';
	}
}
?>

<div class="row justify-content-center">
	<div class="col-12 col-xl-10">
		<div class="content-panel mb-4">
			<div class="d-flex flex-column gap-2">
				<div>
					<p class="text-uppercase text-muted fw-semibold mb-1">Search tasks</p>
					<h1 class="h3 mb-0">Task search results</h1>
				</div>
				<?php if ($query !== ''): ?>
					<div class="alert alert-light border mb-0">
						Searching for: <strong><?php echo htmlspecialchars($query, ENT_QUOTES, 'UTF-8'); ?></strong>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($message !== ''): ?>
				<div class="alert alert-<?php echo $messageType; ?> mt-4 mb-0"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<?php if ($tasks): ?>
				<div class="table-wrap mt-4">
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
								<?php foreach ($tasks as $task): ?>
									<tr>
										<td class="fw-semibold"><?php echo htmlspecialchars($task['title'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><span class="badge <?php echo priorityBadge($task['priority']); ?>"><?php echo htmlspecialchars($task['priority'], ENT_QUOTES, 'UTF-8'); ?></span></td>
										<td><span class="badge <?php echo statusBadge($task['status']); ?>"><?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></span></td>
										<td><?php echo htmlspecialchars($task['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php require_once '../includes/footer.php'; ?>
