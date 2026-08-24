<?php
session_start();

include_once "../includes/navbar.php";
include_once "../connect.php";

$objCon = new Connect();

if (isset($_POST['event_id']) && isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'student') {
    $uid = (int) $_SESSION['user_id'];
    $eid = (int) $_POST['event_id'];
    $stmt = mysqli_prepare($conn, 'INSERT IGNORE INTO event_registrations (user_id,event_id) VALUES (?,?)');
    mysqli_stmt_bind_param($stmt, 'ii', $uid, $eid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: events.php?booked=1');
    exit;
}

$eventsList = $objCon->select("events");
$bookedEventIds = [];
if (isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'student') {
    $bs = mysqli_prepare($conn, 'SELECT event_id FROM event_registrations WHERE user_id=?');
    $studentId = (int) $_SESSION['user_id'];
    mysqli_stmt_bind_param($bs, 'i', $studentId);
    mysqli_stmt_execute($bs);
    $br = mysqli_stmt_get_result($bs);
    while ($r = mysqli_fetch_assoc($br)) {
        $bookedEventIds[] = (int) $r['event_id'];
    }
    mysqli_stmt_close($bs);
}
$categories = $objCon->select("events", "DISTINCT category");
?>

<div class="evt-page-wrapper container my-5">

    <h2 class="evt-title mb-4">Available Events</h2>

    <?php if (isset($_GET['add']) && $_GET['add'] == 'success') { ?>
        <div class="alert alert-info">
            Add event success
        </div>
    <?php } ?>

    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="evt-filter-btn active" data-filter="all">
            All
        </button>

        <?php foreach ($categories as $cat) {
            $catName = is_array($cat) ? $cat['category'] : $cat;
            ?>
            <button class="evt-filter-btn" data-filter="<?= strtolower(trim($catName)); ?>">
                <?= $catName; ?>
            </button>
        <?php } ?>
    </div>

    <h3 class="fw-bold mb-4 text-purple">All Events</h3>
    <div class="row">
        <?php foreach ($eventsList as $event) { ?>
            <div class="col-md-4 mb-4 evt-card-item" data-category="<?= strtolower($event['category']); ?>">
                <div class="card form-card shadow-sm border-0 h-100">
                    <img src="../upload/<?= $event['image']; ?>" alt="<?= $event['title']; ?>" class="card-img-top"
                        style="height: 180px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary"><?= $event['category']; ?></span>
                            <small class="text-muted"><?= $event['created_at']; ?></small>
                        </div>

                        <h5 class="card-title fw-bold text-dark"><?= $event['title']; ?></h5>
                        <p class="card-text text-muted small mb-2"><?= $event['description']; ?></p>

                        <div class="mb-2">
                            <small class="d-block text-muted"><strong>Location:</strong> <?= $event['location']; ?></small>
                            <small class="d-block text-muted"><strong>Date:</strong> <?= $event['event_date']; ?></small>
                        </div>

                        <p class="fw-bold text-purple mb-3">
                            Price: <?= $event['price'] == 0 ? 'Free' : 'EGP ' . $event['price']; ?>
                        </p>

                        <div class="mt-auto">
                            <?php $isBooked = in_array((int) $event['id'], $bookedEventIds, true); ?>
                            <button type="button"
                                class="btn btn-purple w-100 fw-bold <?= $isBooked ? 'booked-event-button' : '' ?>"
                                <?= $isBooked ? 'style="background:#22c55e !important;border-color:#22c55e !important;color:#fff !important;"' : '' ?>     <?= $isBooked ? 'disabled' : '' ?>
                                data-bs-toggle="modal" data-bs-target="#bookingModal"
                                onclick="openBooking(<?= htmlspecialchars(json_encode($event['title']), ENT_QUOTES, 'UTF-8') ?>,<?= (float) $event['price'] ?>,<?= (int) $event['id'] ?>,<?= htmlspecialchars(json_encode($event['event_date']), ENT_QUOTES, 'UTF-8') ?>,<?= htmlspecialchars(json_encode($event['location']), ENT_QUOTES, 'UTF-8') ?>,<?= htmlspecialchars(json_encode('../upload/' . $event['image']), ENT_QUOTES, 'UTF-8') ?>)">
                                <?= $isBooked ? '<span class="booked-text" style="color:#fff !important; ">Booked</span>' : 'Book Now' ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="bookingModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-white" id="bookingModalLabel">Confirm Event Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <img id="modalImage" src="" alt="" class="rounded mb-3"
                    style="height: 180px; object-fit: cover; width: 100%;">

                <div class="bg-light p-3 rounded-3 mb-4 border">
                    <h5 id="modalEventName" class="fw-bold text-dark mb-2"></h5>
                    <p class="mb-1 text-muted small"><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p class="mb-1 text-muted small"><strong>Location:</strong> <span id="modalLocation"></span></p>
                    <p class="mb-1 text-purple fw-bold fs-5 mt-2">Price: <span id="modalPrice"></span></p>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="event_id" id="modalEventId" value="">
                    <input type="hidden" name="user_id" id="userbookingevent"
                        value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
                    <button type="submit" class="btn btn-purple w-100 py-2 fw-bold" <?= !isset($_SESSION['user_id']) ? 'disabled' : '' ?>>
                        <?= isset($_SESSION['user_id']) ? 'Confirm Booking' : 'Log in to Book' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['booked']) && $_GET['booked'] == '1'): ?>
    <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content student-modal">
                <div class="success-icon">✓</div>
                <h3>Booking Successful</h3>
                <p>Your event booking has been confirmed successfully.</p><button class="modal-action learn-more-btn"
                    data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
    <script>document.addEventListener('DOMContentLoaded', function () { var m = document.getElementById('bookingSuccessModal'); if (m && window.bootstrap) { bootstrap.Modal.getOrCreateInstance(m).show(); } });</script>
<?php endif; ?>
<?php include_once "../includes/footer.php"; ?>