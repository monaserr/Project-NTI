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
$cid = (int) ($_POST['course_id'] ?? 0);
$s = mysqli_prepare($conn, 'DELETE FROM course_enrollments WHERE user_id=? AND course_id=?');
mysqli_stmt_bind_param($s, 'ii', $uid, $cid);
$ok = mysqli_stmt_execute($s);
$affected = mysqli_stmt_affected_rows($s);
mysqli_stmt_close($s);
echo json_encode(['success' => $ok && $affected === 1, 'course_id' => $cid, 'removed' => $affected === 1, 'message' => $ok && $affected === 1 ? 'Course removed successfully.' : 'This course is not in your enrolled courses.']);
