<?php
$pageTitle = "Events";
include_once("includes/navbar.php");
?>

<section class="events-hero">
    <div class="container">

        <h1 class="events-title">
            Discover Your Next
            <span>Tech Experience</span>
        </h1>

        <p class="events-description">
            Join workshops, competitions, hackathons and career events
            designed to help you learn, connect and grow.
        </p>

    </div>
</section>

<section class="events-section">

    <div class="container">

        <div class="event-filters">

            <button id="all" class="event-filter active">
                All
            </button>

            <button id="workshop" class="event-filter">
                Workshop
            </button>

            <button id="ai" class="event-filter">
                AI
            </button>

            <button id="competition" class="event-filter">
                Competition
            </button>

            <button id="career" class="event-filter">
                Career
            </button>

            <button id="hackathon" class="event-filter">
                Hackathon
            </button>

        </div>


<div class="row g-4">

    <!-- Event 1 -->
    <div class="col-12 col-md-6 col-lg-4 event-card"
         data-category="Workshop">

        <div class="event-card-inner">

            <div class="event-image-wrapper">
                <img
                    src="images/web-development-concept-isometric-landing-page-team-develops-optimizes-layout-site_9209-7568.avif"
                    alt="Web Development Workshop"
                >
            </div>

            <div class="event-content">

                <span class="event-category">
                    Workshop
                </span>

                <h3>
                    Web Development Workshop
                </h3>

                <p class="event-date">
                    August 20, 2026
                </p>

                <p class="event-price">
                    EGP 150
                </p>

                <button
                    class="event-book-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingModal"
                    onclick="openBooking('Web Development Workshop', 150)"
                >
                    Book Now
                </button>

            </div>

        </div>

    </div>


    <!-- Event 2 -->
    <div class="col-12 col-md-6 col-lg-4 event-card"
         data-category="AI">

        <div class="event-card-inner">

            <div class="event-image-wrapper">
                <img
                    src="images/images.jfif"
                    alt="AI Beginners Session"
                >
            </div>

            <div class="event-content">

                <span class="event-category">
                    AI
                </span>

                <h3>
                    AI Beginners Session
                </h3>

                <p class="event-date">
                    August 25, 2026
                </p>

                <p class="event-price">
                    EGP 100
                </p>

                <button
                    class="event-book-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingModal"
                    onclick="openBooking('AI Beginners Session', 100)"
                >
                    Book Now
                </button>

            </div>

        </div>

    </div>


    <!-- Event 3 -->
    <div class="col-12 col-md-6 col-lg-4 event-card"
         data-category="Competition">

        <div class="event-card-inner">

            <div class="event-image-wrapper">
                <img
                    src="images/Coding-Challenge-push.jpg"
                    alt="Coding Challenge"
                >
            </div>

            <div class="event-content">

                <span class="event-category">
                    Competition
                </span>

                <h3>
                    Coding Challenge
                </h3>

                <p class="event-date">
                    September 2, 2026
                </p>

                <p class="event-price">
                    EGP 50
                </p>

                <button
                    class="event-book-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingModal"
                    onclick="openBooking('Coding Challenge', 50)"
                >
                    Book Now
                </button>

            </div>

        </div>

    </div>


    <!-- Event 4 -->
    <div class="col-12 col-md-6 col-lg-4 event-card"
         data-category="Career">

        <div class="event-card-inner">

            <div class="event-image-wrapper">
                <img
                    src="images/Blog-2-sept.jpg"
                    alt="Career Guidance Day"
                >
            </div>

            <div class="event-content">

                <span class="event-category">
                    Career
                </span>

                <h3>
                    Career Guidance Day
                </h3>

                <p class="event-date">
                    September 10, 2026
                </p>

                <p class="event-price">
                    Free
                </p>

                <button
                    class="event-book-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingModal"
                    onclick="openBooking('Career Guidance Day', 0)"
                >
                    Book Now
                </button>

            </div>

        </div>

    </div>


    <!-- Event 5 -->
    <div class="col-12 col-md-6 col-lg-4 event-card"
         data-category="Hackathon">

        <div class="event-card-inner">

            <div class="event-image-wrapper">
                <img
                    src="images/images (1).jfif"
                    alt="Hackathon"
                >
            </div>

            <div class="event-content">

                <span class="event-category">
                    Hackathon
                </span>

                <h3>
                    Hackathon
                </h3>

                <p class="event-date">
                    September 30, 2026
                </p>

                <p class="event-price">
                    EGP 100
                </p>

                <button
                    class="event-book-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingModal"
                    onclick="openBooking('Hackathon', 100)"
                >
                    Book Now
                </button>

            </div>

        </div>

    </div>

    </div>

</section>


<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <div>
          <p class="eyebrow mb-1">Book your place</p>
          <h3 id="modalEventName" class="modal-title">Event</h3>
        </div>

        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <p class="text-secondary" id = "price">
          Price: 
          <strong id="modalPrice" class="text-primary"></strong>
        </p>

        <form id="bookingForm" novalidate>

          <div class="mb-3">
            <label class="form-label" for="bookingName">Name</label>
            <input id="bookingName" class="form-control"
                   type="text" placeholder="Your full name">
          </div>

          <div class="mb-3">
            <label class="form-label" for="bookingEmail">Email</label>
            <input id="bookingEmail" class="form-control"
                   type="email" placeholder="you@example.com">
          </div>

          <div class="d-flex justify-content-between bg-body-secondary rounded-3 p-3 mb-3">
            <span class="text-secondary">Total</span>
            <strong id="bookingTotal" class="text-primary fs-5">
              EGP 1
            </strong>
          </div>

          <button class="btn btn-primary w-100">
            Confirm Booking
          </button>

        </form>

      </div>
    </div>
  </div>
</div>

<?php
include_once 'includes/footer.php';
?>