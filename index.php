<?php
session_start();

$pageTitle = "Home";
include_once "includes/navbar.php";
include_once "connect.php";


$objCon = new Connect();

if (isset($_POST['event_id'])) {
    if (!isset($_SESSION['userId'])) {
        echo "Please log in first to book this event.";
    }
}

$eventsList = $objCon->select("events");
$limitedEvents = array_slice($eventsList, 0, 3);

$sql = "SELECT * FROM courses";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$tracks = mysqli_fetch_all($result, MYSQLI_ASSOC);

$enrolledCourseIds=[];
if(isset($_SESSION['user_id']) && ($_SESSION['role']??'')==='student'){
    $uid=(int)$_SESSION['user_id'];
    $q=mysqli_prepare($conn,'SELECT course_id FROM course_enrollments WHERE user_id=?');
    mysqli_stmt_bind_param($q,'i',$uid);mysqli_stmt_execute($q);$rr=mysqli_stmt_get_result($q);
    while($r=mysqli_fetch_assoc($rr))$enrolledCourseIds[]=(int)$r['course_id'];mysqli_stmt_close($q);
}

$homeTracks = array_filter($tracks, function ($track) {
    return in_array($track['title'], ['Frontend Development', 'Backend Development', 'AI & Machine Learning']);
});

$trackSkills = [
    'Frontend Development' => ['HTML', 'CSS', 'JavaScript'],
    'Backend Development' => ['PHP', 'MySQL', 'APIs'],
    'AI & Machine Learning' => ['Python', 'ML', 'Data']
];

$trackSlugs = [
    'Frontend Development' => 'frontend',
    'Backend Development' => 'backend',
    'AI & Machine Learning' => 'ai-ml'
];
?>


<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <h1 class="hero-title">Build Your Career Path With <span>Tech Jounery</span></h1>
                <p class="hero-text">Discover the right career path, learn the skills you need,and follow a clear
                    roadmap to become a professional in tech.</p>
                <div class="hero-button">
                    <a href="tracks.php" class="hero-btn" target="_blank">Explore Tracks</a>
                    <a href="index.php#about" class="learn-more-btn">Learn More</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="images/hero1.png" alt="Tech Journey">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section py-5" id="about">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="about-badge">About Us</h3>
            <div class="about-line"></div>
            <h2 class="about-title">Your Career. <span>Your Route.</span> Your Future.</h2>
            <p class="about-subtitle">TechJounery helps you discover the right tech career path and provides a clear
                roadmap to reach their goals.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon"><i class="bi bi-compass"></i></div>
                    <h4>Find Your Path</h4>
                    <p>Explore different tech careers and discover which path matches your interests and goals.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon"><i class="bi bi-map"></i></div>
                    <h4>Learn Step by Step</h4>
                    <p>Follow organized roadmaps that show you exactly what skills you need to learn.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon"><i class="bi bi-rocket-takeoff"></i></div>
                    <h4>Build Your Future</h4>
                    <p>Practice your skills through challenges, projects,and useful resources.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tracks-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="tracks-badge">Career Paths</h3>
            <div class="track-line"></div>
            <h2 class="tracks-title">Choose Your <span>Career Path</span></h2>
            <p class="tracks-subtitle">Explore our carefully designed career paths and start your journey in tech.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($homeTracks as $track): ?>
                <?php
                $title = $track['title'];
                $slug = $trackSlugs[$title] ?? strtolower(str_replace(' ', '-', $title));
                $skills = $trackSkills[$title] ?? [];
                ?>
                <div class="col-md-4">
                    <div class="track-card">
                        <div class="track-image">
                            <img src="images/<?= htmlspecialchars($track['image']) ?>"
                                alt="<?= htmlspecialchars($track['title']) ?>">
                        </div>
                        <div class="track-content">
                            <h3><?= htmlspecialchars($track['title']) ?></h3>
                            <p class="desc"><?= htmlspecialchars($track['description']) ?></p>
                            <div class="track-skills">
                                <?php foreach ($skills as $skill): ?>
                                    <span><?= htmlspecialchars($skill) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="trackcard-buttons d-flex align-items-center gap-3 mt-3">
                                <button type="button" class="enroll-track <?=in_array((int)$track['id'],$enrolledCourseIds,true)?'enrolled':''?>" data-course-id="<?=$track['id']?>" <?=in_array((int)$track['id'],$enrolledCourseIds,true)?'disabled':''?>><?=in_array((int)$track['id'],$enrolledCourseIds,true)?'Enrolled':'Enroll'?></button>
                                <a href="Resources-page.php?track=<?= urlencode($slug) ?>" class="explore-link">Explore
                                    <span>→</span></a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="tracks.php" class="explore-btn" target="_blank">Explore All Tracks <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>

<section class="events-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="events-badge">Our Events</h3>
            <div class="track-line"></div>
            <h2 class="tracks-title">Choose Your <span>Tech Experience</span></h2>
            <p class="events-subtitle">Join Career events to help you learn,contact and grow</p>
        </div>

        <?php if (!empty($limitedEvents)): ?>

            <div class="row g-4 home-events">

                <?php foreach ($limitedEvents as $event): ?>

                    <div class="col-12 col-md-6 col-lg-4 event-card"
                        data-category="<?= htmlspecialchars($event['category']) ?>">

                        <div class="home-event-card">

                            <!-- Event Image -->
                            <div class="home-event-image">
                                <img src="upload/<?= htmlspecialchars($event['image']) ?>"
                                    alt="<?= htmlspecialchars($event['title']) ?>">
                            </div>

                            <!-- Event Content -->
                            <div class="home-event-content">

                                <span class="home-event-category">
                                    <?= htmlspecialchars($event['category']) ?>
                                </span>

                                <h3>
                                    <?= htmlspecialchars($event['title']) ?>
                                </h3>

                                <p class="home-event-date">
                                    <?= htmlspecialchars($event['event_date']) ?>
                                </p>

                                <p class="home-event-price">
                                    <?= $event['price'] == 0
                                        ? 'Free'
                                        : 'EGP ' . htmlspecialchars($event['price']); ?>
                                </p>

                                <a class="event-explore-link" data-bs-toggle="modal"
                                    data-bs-target="#eventModal<?= $event['id'] ?>">

                                    Explore
                                    <span>→</span>

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <?php if (!empty($limitedEvents)): ?>
            <?php foreach ($limitedEvents as $event): ?>

                <div class="modal fade" id="eventModal<?= $event['id']; ?>" tabindex="-1" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <?= $event['title']; ?>
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body">

                                <p><?= $event['description']; ?></p>

                                <p>
                                    <strong>Location:</strong>
                                    <?= $event['location']; ?>
                                </p>

                                <p>
                                    <strong>Date:</strong>
                                    <?= $event['event_date']; ?>
                                </p>

                                <p>
                                    <strong>Price:</strong>
                                    <?= $event['price'] == 0
                                        ? 'Free'
                                        : 'EGP ' . $event['price']; ?>
                                </p>

                            </div>

                            <div class="modal-footer">

                                <a class="event-book-btn" href="students/events.php">

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>
        <?php endif; ?>





        <div class="text-center mt-5">
            <a href="events.php" class="explore-btn" target="_blank">Explore All events <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>







<section class="assess-all py-5">
    <div class="container">
        <section class="assess-banner d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3>Ready to take the first step in your career?</h3>
                <p>Sign up today and start your journey toward a brighter future.</p>
            </div>
            <a href="login.php" class="btn btn-light assessment-btn" target="_blank">Start Jounery →</a>
        </section>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll(
            ".about-badge,.about-line,.about-title,.about-subtitle," +
            ".tracks-badge,.track-line,.tracks-title,.tracks-subtitle," +
            ".events-badge,.events-subtitle," +
            ".about-card,.track-card,.home-event-card,.assess-banner"
        );

        const observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: .15
        });

        elements.forEach(function (element) {
            observer.observe(element);
        });
    });
</script>

<div class="modal fade" id="enrollSuccessModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content student-modal"><div class="success-icon">✓</div><h3>Enrollment Successful!</h3><p>You are now enrolled in this track.</p><button class="modal-action learn-more-btn" data-bs-dismiss="modal">Continue</button></div></div></div><script>document.addEventListener('DOMContentLoaded',()=>{document.querySelectorAll('.enroll-track').forEach(btn=>btn.addEventListener('click',async()=>{if(btn.disabled)return;const fd=new FormData();fd.append('course_id',btn.dataset.courseId);const old=btn.textContent;btn.disabled=true;try{const r=await fetch('enroll.php',{method:'POST',body:fd});const d=await r.json();if(!d.success)throw Error(d.message);btn.textContent='Enrolled';btn.classList.add('enrolled');bootstrap.Modal.getOrCreateInstance(document.getElementById('enrollSuccessModal')).show();}catch(e){btn.disabled=false;btn.textContent=old;alert(e.message);}}));});</script><?php include_once "includes/footer.php"; ?>