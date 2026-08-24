<?php
session_start();
require_once 'connect.php';
require_once 'student_helpers.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$uid = (int) $_SESSION['user_id'];
$role = $_SESSION['role'] ?? '';

$uStmt = mysqli_prepare($conn, 'SELECT * FROM users WHERE id=? LIMIT 1');
mysqli_stmt_bind_param($uStmt, 'i', $uid);
mysqli_stmt_execute($uStmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($uStmt));
mysqli_stmt_close($uStmt);

if ($role === 'instructor') {
    $eStmt = mysqli_prepare($conn, 'SELECT * FROM events WHERE instructor_id=? ORDER BY event_date ASC,id DESC');
    mysqli_stmt_bind_param($eStmt, 'i', $uid);
    mysqli_stmt_execute($eStmt);
    $events = mysqli_fetch_all(mysqli_stmt_get_result($eStmt), MYSQLI_ASSOC);
    mysqli_stmt_close($eStmt);

    $bookings = [];
    $bStmt = mysqli_prepare($conn, 'SELECT er.event_id,u.first_name,u.last_name,u.email,er.registered_at FROM event_registrations er JOIN users u ON u.id=er.user_id JOIN events e ON e.id=er.event_id WHERE e.instructor_id=? ORDER BY er.registered_at DESC');
    mysqli_stmt_bind_param($bStmt, 'i', $uid);
    mysqli_stmt_execute($bStmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($bStmt), MYSQLI_ASSOC);
    mysqli_stmt_close($bStmt);
    foreach ($rows as $row) {
        $bookings[(int) $row['event_id']][] = $row;
    }

    $pageTitle = 'Instructor Profile';
    include 'includes/navbar.php';
    $initials = student_initials($user);
    ?>
    <main class="student-profile-page">
        <div class="container profile-shell">
            <div class="profile-top">
                <div class="avatar">
                    <?php if (!empty($user['image'])): ?><img src="<?= htmlspecialchars($user['image']) ?>"
                            alt="Profile Photo">
                    <?php else: ?><span><?= htmlspecialchars($initials) ?></span><?php endif; ?>
                </div>
                <div>
                    <h1><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h1>
                    <div class="muted"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </div>

            <section class="profile-section">
                <div class="section-head">
                    <h2>My Data</h2><a href="edit_profile.php" class="learn-more-btn">Edit Profile</a>
                </div>
                <div class="data-grid">
                    <div class="data-box"><small>First
                            Name</small><strong><?= htmlspecialchars($user['first_name']) ?></strong></div>
                    <div class="data-box"><small>Last Name</small><strong><?= htmlspecialchars($user['last_name']) ?></strong>
                    </div>
                    <div class="data-box"><small>Role:</small> <strong><?= htmlspecialchars(ucfirst($role)) ?></strong></div>
                    <div class="data-box"><small>Email</small><strong><?= htmlspecialchars($user['email']) ?></strong></div>
                    <div class="data-box"><small>Password</small><strong>••••••••</strong></div>
                </div>
            </section>

            <section class="profile-section">
                <div class="section-head">
                    <h2>My Events</h2><a href="instructors/add_events.php" class="learn-more-btn">Add New Event</a>
                </div>
                <?php if ($events): ?>
                    <div class="row g-4 instructor-events-list">
                        <?php foreach ($events as $event):
                            $students = $bookings[(int) $event['id']] ?? [];
                            $count = count($students);
                            $panelId = 'students-' . $event['id']; ?>
                            <div class="col-12">
                                <div class="instructor-event-card">
                                    <div class="instructor-event-main">
                                        <div class="instructor-event-image">
                                            <?php if (!empty($event['image'])): ?><img
                                                    src="upload/<?= htmlspecialchars($event['image']) ?>"
                                                    alt="<?= htmlspecialchars($event['title']) ?>"><?php endif; ?>
                                        </div>
                                        <div class="instructor-event-info">
                                            <span class="home-event-category"><?= htmlspecialchars($event['category']) ?></span>
                                            <h3><?= htmlspecialchars($event['title']) ?></h3>
                                            <p class="desc"><?= htmlspecialchars($event['description']) ?></p>
                                            <div class="instructor-event-meta"><span><strong>Date:</strong>
                                                    <?= htmlspecialchars($event['event_date']) ?></span><span><strong>Location:</strong>
                                                    <?= htmlspecialchars($event['location']) ?></span></div>
                                            <p class="home-event-price">
                                                <?= ((int) $event['price'] === 0 ? 'Free' : 'EGP ' . (int) $event['price']) ?></p>
                                        </div>
                                        <div class="instructor-event-actions">
                                            <div class="event-edit-delete"><a
                                                    href="instructors/edit_events.php?id=<?= $event['id'] ?>"
                                                    class="learn-more-btn">Edit</a>
                                                <form action="instructors/add_events.php" method="post"
                                                    onsubmit="return confirm('Are you sure you want to delete this event?');"><input
                                                        type="hidden" name="id" value="<?= $event['id'] ?>"><button type="submit"
                                                        class="remove-btn">Delete</button></form>
                                            </div>
                                            <button type="button" class="students-toggle" data-bs-toggle="collapse"
                                                data-bs-target="#<?= $panelId ?>" aria-expanded="false"
                                                aria-controls="<?= $panelId ?>"><span>👥 Students who booked (<?= $count ?>)</span><span
                                                    class="students-chevron">⌄</span></button>
                                        </div>
                                    </div>
                                    <div class="collapse instructor-students-collapse" id="<?= $panelId ?>">
                                        <div class="instructor-students-box">
                                            <div class="instructor-students-title">Students who booked this event</div>
                                            <?php if ($students): ?>
                                                <div class="table-responsive">
                                                    <table class="table instructor-students-table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Student Name</th>
                                                                <th>Email</th>
                                                                <th>Booked At</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($students as $i => $student): ?>
                                                                <tr>
                                                                    <td><?= ($i + 1) ?></td>
                                                                    <td><strong><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></strong>
                                                                    </td>
                                                                    <td><?= htmlspecialchars($student['email']) ?></td>
                                                                    <td><?= htmlspecialchars($student['registered_at']) ?></td>
                                                                </tr><?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php else: ?>
                                                <div class="instructor-no-students">No students have booked this event yet.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">You have not created any event yet.</div><?php endif; ?>
            </section>
        </div>
    </main>
    <?php include 'includes/footer.php';
    exit;
}

if (!student_logged_in()) {
    header('Location: login.php');
    exit;
}
$uid = (int) $_SESSION['user_id'];
$uStmt = mysqli_prepare($conn, 'SELECT * FROM users WHERE id=? LIMIT 1');
mysqli_stmt_bind_param($uStmt, 'i', $uid);
mysqli_stmt_execute($uStmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($uStmt));
mysqli_stmt_close($uStmt);
$cs = mysqli_prepare($conn, 'SELECT c.* FROM course_enrollments ce JOIN courses c ON c.id=ce.course_id WHERE ce.user_id=? ORDER BY ce.enrolled_at DESC');
mysqli_stmt_bind_param($cs, 'i', $uid);
mysqli_stmt_execute($cs);
$courses = mysqli_fetch_all(mysqli_stmt_get_result($cs), MYSQLI_ASSOC);
mysqli_stmt_close($cs);
$es = mysqli_prepare($conn, 'SELECT e.* FROM event_registrations er JOIN events e ON e.id=er.event_id WHERE er.user_id=? ORDER BY e.event_date ASC');
mysqli_stmt_bind_param($es, 'i', $uid);
mysqli_stmt_execute($es);
$events = mysqli_fetch_all(mysqli_stmt_get_result($es), MYSQLI_ASSOC);
mysqli_stmt_close($es);
$pageTitle = 'My Profile';
include 'includes/navbar.php';
$initials = student_initials($user);
?>
<main class="student-profile-page">
    <div class="container profile-shell">

        <div class="profile-top">
            <div class="avatar">
                <?php if (!empty($user['image'])): ?>
                    <img src="<?= htmlspecialchars($user['image']) ?>" alt="Profile Photo">
                <?php else: ?>
                    <span><?= htmlspecialchars($initials) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <h1><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h1>
                <div class="muted"><?= htmlspecialchars($user['email']) ?></div>
            </div>
        </div>

        <section class="profile-section">
            <div class="section-head">
                <h2>My Data</h2>
                <a href="edit_profile.php" class="learn-more-btn">Edit Profile</a>
            </div>
            <div class="data-grid">
                <div class="data-box"><small>First
                        Name</small><strong><?= htmlspecialchars($user['first_name']) ?></strong></div>
                <div class="data-box"><small>Last Name</small><strong><?= htmlspecialchars($user['last_name']) ?></strong>
                </div>
                <div class="data-box"><small>Email</small><strong><?= htmlspecialchars($user['email']) ?></strong></div>
                <div class="data-box"><small>Password</small><strong>••••••••</strong></div>
            </div>
        </section>

        <!-- My Courses -->
        <section class="profile-section">
            <div class="section-head">
                <h2>My Courses</h2>
            </div>

            <?php if ($courses): ?>
                <div class="row g-4 student-profile-track-grid">
                    <?php foreach ($courses as $course): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="track-card student-profile-track-card">
                                <div class="track-image">
                                    <img src="images/<?= htmlspecialchars($course['image']) ?>"
                                        alt="<?= htmlspecialchars($course['title']) ?>">
                                </div>
                                <div class="track-content">
                                    <h3><?= htmlspecialchars($course['title']) ?></h3>
                                    <p class="desc"><?= htmlspecialchars($course['description']) ?></p>
                                    <div class="trackcard-buttons student-profile-card-actions">

                                       <?php
                                        $courseTitle = strtolower(trim($course['title']));

                                        $trackMap = [
                                            'frontend' => 'frontend',
                                            'frontend development' => 'frontend',

                                            'backend' => 'backend',
                                            'backend development' => 'backend',

                                            'ai' => 'ai-ml',
                                            'ai & machine learning' => 'ai-ml',
                                            'ai and machine learning' => 'ai-ml',

                                            'cybersecurity' => 'cybersecurity',
                                            'cyber security' => 'cybersecurity',

                                            'data science' => 'data-science',
                                            'data-science' => 'data-science',
                                        ];

                                        $trackSlug = $trackMap[$courseTitle] ?? 'all';
                                        ?>

                                        <a class="explore-link"
                                        href="Resources-page.php?track=<?= urlencode($trackSlug) ?>&course_id=<?= (int)$course['id'] ?>#top">
                                            Explore <span>→</span>
                                        </a>
                                        <button type="button" class="remove-btn profile-course-remove"
                                            data-course-id="<?= $course['id'] ?>">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">You have not enrolled in any course yet.</div>
            <?php endif; ?>
        </section>

        <!-- My Events: same card structure/behavior as My Courses -->
        <section class="profile-section">
            <div class="section-head">
                <h2>My Events</h2>
            </div>

            <?php if ($events): ?>
                <div class="row g-4 student-profile-event-grid">
                    <?php foreach ($events as $event): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="track-card student-profile-event-card">
                                <div class="track-image">
                                    <img src="upload/<?= htmlspecialchars($event['image']) ?>"
                                        alt="<?= htmlspecialchars($event['title']) ?>">
                                </div>

                                <div class="track-content">
                                    <span class="home-event-category"><?= htmlspecialchars($event['category']) ?></span>
                                    <h3><?= htmlspecialchars($event['title']) ?></h3>

                                    <p class="desc">
                                        <?= htmlspecialchars($event['event_date']) ?>
                                        · <?= htmlspecialchars($event['location']) ?>
                                    </p>

                                    <p class="home-event-price">
                                        <?= ((int) $event['price'] === 0 ? 'Free' : 'EGP ' . (int) $event['price']) ?>
                                    </p>

                                    <div class="trackcard-buttons student-profile-card-actions">
                                        <span class="booked-event-label">Booked</span>
                                        <button type="button" class="remove-btn event-remove" data-event-id="<?= $event['id'] ?>">
                                            Cancel Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">You have not booked any event yet.</div>
            <?php endif; ?>
        </section>

    </div>
</main>

<div class="modal fade" id="studentActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content student-modal">
            <div id="studentModalIcon" class="success-icon">✓</div>
            <h3 id="studentModalTitle">Success</h3>
            <p id="studentModalText">Done successfully.</p>
            <button class="modal-action learn-more-btn" data-bs-dismiss="modal">Continue</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modalElement = document.getElementById('studentActionModal');
        const modal = new bootstrap.Modal(modalElement);
        const icon = document.getElementById('studentModalIcon');
        const title = document.getElementById('studentModalTitle');
        const text = document.getElementById('studentModalText');

        function showActionModal(titleText, message, isRemove = false) {
            title.textContent = titleText;
            text.textContent = message;
            icon.className = 'success-icon' + (isRemove ? ' remove-icon' : '');
            icon.textContent = isRemove ? '−' : '✓';
            modal.show();
        }

        async function readJsonResponse(response) {
            const raw = await response.text();

            try {
                return JSON.parse(raw);
            } catch (e) {
                console.error('Server response was not valid JSON:', raw);
                throw new Error(
                    response.status === 401
                        ? 'Your student session has expired. Please log in again.'
                        : 'The server returned an invalid response. Please try again.'
                );
            }
        }

        // Cancel course
        document.querySelectorAll('.profile-course-remove').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const courseId = btn.dataset.courseId;
                const cardCol = btn.closest('.col-md-6, .col-lg-4');

                btn.disabled = true;

                try {
                    const fd = new FormData();
                    fd.append('course_id', courseId);

                    const response = await fetch('cancel_enrollment.php', {
                        method: 'POST',
                        body: fd,
                        headers: { 'Accept': 'application/json' }
                    });

                    const data = await readJsonResponse(response);

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Could not remove the course.');
                    }

                    if (cardCol) cardCol.remove();

                    try {
                        const removed = JSON.parse(localStorage.getItem('techJourneyRemovedCourses') || '[]');
                        const id = String(courseId);
                        if (!removed.includes(id)) removed.push(id);
                        localStorage.setItem('techJourneyRemovedCourses', JSON.stringify(removed));
                    } catch (_) { }

                    if (document.querySelectorAll('.student-profile-track-card').length === 0) {
                        const grid = document.querySelector('.student-profile-track-grid');
                        if (grid) {
                            grid.innerHTML = '<div class="col-12"><div class="empty-state">You have not enrolled in any course yet.</div></div>';
                        }
                    }

                    showActionModal('Course Removed', 'The track has been removed from your profile successfully.', true);
                } catch (error) {
                    btn.disabled = false;
                    showActionModal('Something went wrong', error.message || 'Please try again.');
                }
            });
        });

        // Cancel event booking
        document.querySelectorAll('.event-remove').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const eventId = btn.dataset.eventId;
                const cardCol = btn.closest('.col-md-6, .col-lg-4');

                btn.disabled = true;

                try {
                    const fd = new FormData();
                    fd.append('event_id', eventId);

                    const response = await fetch('cancel_event.php', {
                        method: 'POST',
                        body: fd,
                        headers: { 'Accept': 'application/json' }
                    });

                    const data = await readJsonResponse(response);

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Could not cancel the booking.');
                    }

                    if (cardCol) cardCol.remove();

                    if (document.querySelectorAll('.student-profile-event-card').length === 0) {
                        const grid = document.querySelector('.student-profile-event-grid');
                        if (grid) {
                            grid.innerHTML = '<div class="col-12"><div class="empty-state">You have not booked any event yet.</div></div>';
                        }
                    }

                    showActionModal('Booking Cancelled', 'Your event booking has been cancelled successfully.', true);
                } catch (error) {
                    btn.disabled = false;
                    showActionModal('Something went wrong', error.message || 'Please try again.');
                }
            });
        });
    });
</script>

<?php include 'includes/footer.php'; ?>