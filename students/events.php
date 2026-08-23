<?php
session_start();

include_once "../includes/navbar.php";
include_once "../connect.php";

$objCon = new Connect();

if (isset($_POST['event_id'])) {
    if (!isset($_SESSION['userId'])) {
       echo "Please log in first to book this event.";
    } 
        if ($objCon->insert($_POST, "event_registrations")) {
           echo "Event booked successfully!";
        } else {
          echo "Failed to complete booking or already registered.";
        }
    }

$eventsList = $objCon->select("events");
$categories  = $objCon->select("events", "DISTINCT category");
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
                    <img src="../upload/<?= $event['image']; ?>"
                         alt="<?= $event['title']; ?>"
                         class="card-img-top"
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
                            <button type="button" 
                                    class="btn btn-purple w-100 fw-bold"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#bookingModal"
                                    onclick="openBooking(
                                        '<?= $event['title']; ?>', 
                                        <?= $event['price']; ?>, 
                                        '<?= $event['id']; ?>', 
                                        '<?= $event['event_date']; ?>', 
                                        '<?= $event['location']; ?>', 
                                        '../upload/<?= $event['image']; ?>'
                                    )">
                                Book Now
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
                <img id="modalImage" src="" alt="" class="rounded mb-3" style="height: 180px; object-fit: cover; width: 100%;">
                
                <div class="bg-light p-3 rounded-3 mb-4 border">
                    <h5 id="modalEventName" class="fw-bold text-dark mb-2"></h5>
                    <p class="mb-1 text-muted small"><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p class="mb-1 text-muted small"><strong>Location:</strong> <span id="modalLocation"></span></p>
                    <p class="mb-1 text-purple fw-bold fs-5 mt-2">Price: <span id="modalPrice"></span></p>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="event_id" id="modalEventId" value="">
                    <input type="hidden" name="user_id" id="userbookingevent" value="<?= isset($_SESSION['userId']) ? $_SESSION['userId'] : ''; ?>">
                    <button type="submit" class="btn btn-purple w-100 py-2 fw-bold" <?= !isset($_SESSION['userId']) ? 'disabled' : '' ?>>
                        <?= isset($_SESSION['userId']) ? 'Confirm Booking' : 'Log in to Book' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../includes/footer.php";
?>