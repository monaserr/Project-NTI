<?php
session_start();
require_once 'connect.php';
require_once 'student_helpers.php';
header('Content-Type: application/json; charset=utf-8');
if (!student_logged_in()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Please log in as a student first.']);
    exit;
}
$uid = (int) $_SESSION['user_id'];
$eid = (int) ($_POST['event_id'] ?? 0);
$s = mysqli_prepare($conn, 'DELETE FROM event_registrations WHERE user_id=? AND event_id=?');
mysqli_stmt_bind_param($s, 'ii', $uid, $eid);
$ok = mysqli_stmt_execute($s);
$affected = mysqli_stmt_affected_rows($s);
mysqli_stmt_close($s);
echo json_encode(['success' => $ok && $affected === 1, 'message' => $ok ? 'Event booking cancelled successfully.' : 'This event is not booked.']);
