<?php
function sanitize($data) {
	$data = trim($data);
	$data = strip_tags($data);
	return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function getAllTasks($conn) {
	$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
	return $conn->query($sql);
}

function getTaskById($conn, $id) {
	$id = (int) $id;
	$sql = $conn->prepare("SELECT * FROM tasks WHERE id = ? LIMIT 1");
	if (!$sql) return null;
	$sql->bind_param('i', $id);
	$sql->execute();
	$result = $sql->get_result();
	$task = $result->fetch_assoc();
	$sql->close();
	return $task;
}

function priorityBadge($priority) {
	switch ($priority) {
		case 'High': return 'badge-high';
		case 'Medium': return 'badge-medium';
		default: return 'badge-low';
	}
}

function statusBadge($status) {
	return ($status === 'Completed') ? 'badge-completed' : 'badge-pending';
}

function redirectWith($msg, $type = 'success') {
	$loc = '../index.php?msg=' . urlencode($msg) . '&type=' . urlencode($type);
	header('Location: ' . $loc);
	exit();
}

?>
