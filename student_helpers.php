<?php
function student_logged_in(): bool
{
    return isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'student';
}
function student_initials(array $user): string
{
    return strtoupper(substr($user['first_name'] ?? '', 0, 1) . substr($user['last_name'] ?? '', 0, 1));
}
function student_image_url(string $path, string $base = ''): string
{
    return $path !== '' ? $base . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') : '';
}
?>