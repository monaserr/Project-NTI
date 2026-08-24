<?php

include_once "../includes/navbar.php";
include_once "../connect.php";

$objCon = new Connect();

if (isset($_POST['id'])) {
    if ($objCon->delete("events", (int) $_POST['id'])) {
        header("location: add_events.php?delete=success");
        exit();
    } else {
        $errorMsg = "Failed to delete event";
    }
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

    $_POST['instructor_id'] = $_SESSION['user_id'];

    if ($objCon->insert($_POST, "events")) {
        header('location: add_events.php?add=success');
        exit();
    } else {
        echo "Failed to add event";
    }
}

$eventsList = $objCon->select("events");

?>

<div class="evt-page-wrapper container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card evt-add-form-card p-4 mb-5">
                <h2 class="text-center mb-4 fw-bold text-purple">Add New Event</h2>

                <?php if (isset($_GET['delete']) && $_GET['delete'] == 'success') { ?>
                    <div class="alert alert-success">
                        Delete event success
                    </div>
                <?php } ?>

                <?php if (isset($_GET['add']) && $_GET['add'] == 'success') { ?>
                    <div class="alert alert-info">
                        Add event success
                    </div>
                <?php } ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event_name" name="title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="event_category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="event_category" name="category">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="event_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="event_price" name="price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="event_location" name="location">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="created_at" class="form-label">Created At</label>
                            <input type="date" class="form-control" id="created_at" name="created_at"
                                value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-4">
                        <label for="event_image" class="form-label">Event Banner Image</label>

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

                    <button type="submit" class="btn btn-event w-100 py-2 fw-bold">
                        Create Event
                    </button>
                </form>
            </div>
        </div>
    </div>

    <h3 class="fw-bold mb-4 text-purple">All Events</h3>
    <div class="row">
        <?php foreach ($eventsList as $event) { ?>
            <div class="col-md-4 mb-4 evt-card-item">
                <div class="card form-card shadow-sm border-0 h-100">

                    <img src="../upload/<?= $event['image']; ?>" alt="<?= $event['title']; ?>"
                        style="height: 180px; object-fit: cover; border-radius: 10px;" class="card-img-top mb-2">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary">
                                <?= $event['category']; ?>
                            </span>
                            <small class="text-muted"><?= $event['created_at']; ?></small>
                        </div>

                        <h5 class="card-title fw-bold text-dark"><?= $event['title']; ?></h5>

                        <p class="card-text text-muted small mb-2">
                            <?= $event['description']; ?>
                        </p>

                        <div class="mb-2">
                            <small class="d-block text-muted"><strong>Location:</strong> <?= $event['location']; ?></small>
                            <small class="d-block text-muted"><strong>Date:</strong> <?= $event['event_date']; ?></small>
                        </div>

                        <p class="fw-bold text-purple mb-3">Price: EGP <?= $event['price']; ?></p>

                        <div class="mt-auto d-flex gap-2">
                            <a href="edit_events.php?id=<?= $event['id']; ?>"
                                class="btn btn-outline-purple btn-sm flex-fill">
                                Edit
                            </a>

                            <form action="" method="post" class="flex-fill"
                                onsubmit="return confirm('Are you sure you want to delete this event?');">
                                <input type="hidden" name="id" value="<?= $event['id']; ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include_once "../includes/footer.php";
?>