<?php
$pageTitle = "Home";
include_once "includes/navbar.php";
?>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <!-- Left Side -->
            <div class="col-lg-6">
                <h1 class="hero-title">
                    Build Your
                    Career Path With
                    <span>Tech Jounery</span>
                </h1>
                <p class="hero-text">

                    Discover the right career path, learn the skills you need,
                    and follow a clear roadmap to become a professional in tech.

                </p>
                <div class="hero-button">

                    <a
                        href="tracks.php"
                        class="hero-btn"
                        target="blank">
                        Explore Tracks
                    </a>
                    <a
                        href="index.php#about"
                        class="learn-more-btn">
                        Learn More
                    </a>
                </div>
            </div>
            <!-- Right Side -->
            <div class="col-lg-6">

                <div class="hero-image">
                    <img
                        src="images/hero1.png"
                        alt="Tech Journey">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT US SECTION -->
<section class="about-section py-5" id="about">

    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">

            <h3 class="about-badge">
                About Us
            </h3>

            <div class="about-line"></div>

            <h2 class="about-title">
                Your Career.
                <span>Your Route.</span>
                Your Future.
            </h2>
            <p class="about-subtitle">
                TechJounery helps you discover the right tech career path
                and provides a clear roadmap to reach their goals.
            </p>
        </div>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="about-card">

                    <div class="about-icon">
                        <i class="bi bi-compass"></i>
                    </div>
                    <h4>
                        Find Your Path
                    </h4>
                    <p>
                        Explore different tech careers and discover
                        which path matches your interests and goals.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">

                    <div class="about-icon">
                        <i class="bi bi-map"></i>
                    </div>

                    <h4>
                        Learn Step by Step
                    </h4>
                    <p>

                        Follow organized roadmaps that show you
                        exactly what skills you need to learn.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">

                    <div class="about-icon">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>

                    <h4>
                        Build Your Future
                    </h4>
                    <p>
                        Practice your skills through challenges,
                        projects, and useful resources.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tracks-section py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h3 class="tracks-badge">
                Career Paths
            </h3>
            <div class="track-line"></div>

            <h2 class="tracks-title">

                Choose Your
                <span>Career Path</span>

            </h2>
            <p class="tracks-subtitle">
                Explore our carefully designed career paths
                and start your journey in tech.

            </p>

        </div>
        <div class="row g-4">

            <div class="col-md-4">

                <div class="track-card">
                    <div class="track-image">
                        <img
                            src="images/Frontend.jpg"
                            alt="Frontend Development">
                    </div>
                    <div class="track-content">
                        <h3>
                            Frontend Development
                        </h3>
                        <p class="desc">
                            Learn how to build beautiful, responsive,
                            and interactive websites.
                        </p>
                        <div class="track-skills">

                            <span>HTML</span>
                            <span>CSS</span>
                            <span>JavaScript</span>
                        </div>
                        <a
                            href="Resources-page.php?track=frontend"
                            class="explore-link">
                            Explore
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="track-card">

                    <div class="track-image">
                        <img
                            src="images/backend.png"
                            alt="Backend Development">
                    </div>
                    <div class="track-content">

                        <h3>
                            Backend Development
                        </h3>
                        <p class="desc">
                            Build powerful server-side applications,
                            APIs, and database systems.
                        </p>

                        <div class="track-skills">
                            <span>PHP</span>
                            <span>MySQL</span>
                            <span>APIs</span>
                        </div>
                        <a
                            href="Resources-page.php?track=backend" class="explore-link"> Explore<span>→</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="track-card">
                    <div class="track-image">
                        <img
                            src="images/aiTrack.jpg"
                            alt="AI & Machine Learning">
                    </div>
                    <div class="track-content">
                        <h3>
                            AI & Machine Learning
                        </h3>
                        <p class="desc">
                            Learn how machines learn from data
                            and build intelligent applications.
                        </p>
                        <div class="track-skills">
                            <span>Python</span>
                            <span>ML</span>
                            <span>Data</span>
                        </div>
                        <a
                            href="Resources-page.php?track=ai-ml" class="explore-link">
                            Explore
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a
                href="tracks.php" class="explore-btn" target="blank">
                Explore All Tracks
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<section class="events-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="events-badge">
                Our Events
            </h3>
            <div class="track-line"></div>
            <h2 class="tracks-title">
                Choose Your
                <span>Tech Experience</span>
            </h2>
            <p class="events-subtitle">
                join Career events to help you learn, contact and grow
            </p>
        </div>
        <div class="row g-4 home-events">
            <div
                class="col-12 col-md-6 col-lg-4 event-card" data-category="Workshop">
                <div class="home-event-card">
                    <div class="home-event-image">
                        <img
                            src="images/web-development-concept-isometric-landing-page-team-develops-optimizes-layout-site_9209-7568.avif" alt="Web Development Workshop">

                    </div>
                    <div class="home-event-content">

                        <span class="home-event-category">
                            Workshop
                        </span>

                        <h3>
                            Web Development Workshop
                        </h3>

                        <p class="home-event-date">
                            August 20, 2026
                        </p>

                        <p class="home-event-price">
                            EGP 150
                        </p>
                        <a
                            class="explore-link" data-bs-toggle="modal"  data-bs-target="#eventModal1">Explore <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-md-6 col-lg-4 event-card" data-category="AI">
                <div class="home-event-card">
                    <div class="home-event-image">
                        <img
                            src="images/images.jfif"  alt="AI Beginners Session">
                    </div>
                    <div class="home-event-content">
                        <span class="home-event-category">
                            AI
                        </span>
                        <h3>
                            AI Beginners Session
                        </h3>
                        <p class="home-event-date">
                            August 25, 2026
                        </p>
                        <p class="home-event-price">
                            EGP 100
                        </p>
                        <a
                            class="explore-link"  data-bs-toggle="modal" data-bs-target="#eventModal2"> Explore <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-md-6 col-lg-4 event-card"
                data-category="Competition">
                <div class="home-event-card">
                    <div class="home-event-image">
                        <img  src="images/Coding-Challenge-push.jpg" alt="Coding Challenge">
                    </div>
                    <div class="home-event-content">
                        <span class="home-event-category">
                            Competition
                        </span>
                        <h3>   Coding Challenge</h3>
                        <p class="home-event-date">  September 2, 2026 </p>
                        <p class="home-event-price"> EGP 50 </p>
                        <a  class="explore-link" data-bs-toggle="modal" data-bs-target="#eventModal3">   Explore <span>→</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a
                href="events.php" class="explore-btn" target="blank"> Explore All events<i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<div class="modal fade" id="eventModal1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  Web Development Workshop  </h5>
                <button type="button"  class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>
                    Learn the basics of web development and discover
                    how to build modern and responsive websites.</p>
                <p><strong>Date:</strong> August 20, 2026 </p>
                <p> <strong>Price:</strong> EGP 150 </p>
            </div>
            <div class="modal-footer">
                <a  href="events.php"  class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> AI Beginners Session </h5>
                <button  type="button" class="btn-close" data-bs-dismiss="modal">  </button>
            </div>
            <div class="modal-body">
                <p>
                    Get introduced to Artificial Intelligence,
                    machine learning, and how AI is used in real-world applications.
                </p>
                <p><strong>Date:</strong> August 25, 2026</p>
                <p><strong>Price:</strong> EGP 100 </p>
            </div>
            <div class="modal-footer">
                <a href="events.php"  class="btn btn-primary"> Book Now</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Coding Challenge  </h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal"> </button>
            </div>
            <div class="modal-body">
                <p>
                    Test your programming skills by solving
                    different coding problems and challenges.
                </p>
                <p>
                    <strong>Date:</strong> September 2, 2026
                </p>
                <p> <strong>Price:</strong> EGP 50
                </p>
            </div>
            <div class="modal-footer">
                <a href="event.php" class="btn btn-primary">Book Now </a>
            </div>
        </div>
    </div>
</div>

<section class="assess-all py-5">
    <div class="container">
        <section
            class="assess-banner d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3>  Ready to take the first step in your career?</h3>
                <p>Sign up today and start your journey toward a brighter future. </p>
            </div>
            <a href="login.php"class="btn btn-light assessment-btn" target="blank"> Start Jounery → </a>
        </section>
    </div>
</section>
<?php
include_once 'includes/footer.php';
?>