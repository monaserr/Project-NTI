<?php

include_once "../includes/navbar.php";
include_once "../connect.php";

$objCon = new Connect();

if (!isset($_GET['id'])) {
    header('location: add_events.php');
    exit();
}
$eventId = (int) $_GET['id'];

$event = $objCon->selectOne("events", $eventId);

if (empty($event)) {
    header('location: add_events.php');
    exit();
}

if (isset($_POST['title'])) {

    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../upload/" . $imageName
        );

        $_POST['image'] = $imageName;
    }

    if ($objCon->update($_POST, "events", $eventId)) {
        header('location: add_events.php?update=success');
        exit();
    } else {
        $errorMsg = "Failed to update event";
    }
}

?>

<div class="evt-page-wrapper container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card evt-edit-form-card p-4 mb-5">
                <h2 class="text-center mb-4 fw-bold text-purple">Edit Event</h2>

                <?php if (isset($errorMsg)) { ?>
                    <div class="alert alert-danger">
                        <?= $errorMsg; ?>
                    </div>
                <?php } ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event_name" name="title"
                                value="<?= $event['title']; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="event_category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="event_category" name="category"
                                value="<?= $event['category']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date"
                                value="<?= $event['event_date']; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="event_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="event_price" name="price"
                                value="<?= $event['price']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="event_location" name="location"
                                value="<?= $event['location']; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="created_at" class="form-label">Created At</label>
                            <input type="text" class="form-control" id="created_at" name="created_at"
                                value="<?= $event['created_at']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="<?= $event['description']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Current Image</label>
                        <?php if (!empty($event['image'])) { ?>
                            <img src="../upload/<?= $event['image']; ?>" alt="<?= $event['title']; ?>"
                                style="height: 120px; object-fit: cover; border-radius: 10px;" class="mb-2">
                        <?php } else { ?>
                            <p class="text-muted small">No image uploaded</p>
                        <?php } ?>
                    </div>

                    <div class="mb-4">
                        <label for="event_image" class="form-label">Replace Banner Image (optional)</label>

                        <div class="custom-file">
                            <input type="file" name="image" id="event_image" accept="image/jpeg,image/png,image/webp">

                            <label for="event_image" class="choose-file-btn">
                                <span class="upload-icon">↑</span>
                                Choose File
                            </label>

                            <span class="file-name" id="eventFileName">No file chosen</span>
                        </div>

                        <small class="file-note">
                            Optional - JPG, PNG or WEBP, maximum 2MB
                        </small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-save w-100 py-2 fw-bold">
                            Save Changes
                        </button>
                        <a href="add_events.php" class="btn btn-outline-secondary w-100 py-2 fw-bold text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../includes/footer.php";
?>