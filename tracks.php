<?php
session_start();

$pageTitle="Tracks";
include_once("includes/navbar.php");
include_once("connect.php");

$sql="SELECT * FROM courses";
$result=mysqli_query($conn,$sql);

if(!$result){
    die("Query failed: ".mysqli_error($conn));
}

$tracks=mysqli_fetch_all($result,MYSQLI_ASSOC);

$enrolledCourseIds=[];
if(isset($_SESSION['user_id']) && ($_SESSION['role']??'')==='student'){
    $uid=(int)$_SESSION['user_id'];
    $q=mysqli_prepare($conn,'SELECT course_id FROM course_enrollments WHERE user_id=?');
    mysqli_stmt_bind_param($q,'i',$uid);mysqli_stmt_execute($q);$rr=mysqli_stmt_get_result($q);
    while($r=mysqli_fetch_assoc($rr))$enrolledCourseIds[]=(int)$r['course_id'];mysqli_stmt_close($q);
}

$roadmaps=[
    "Frontend Development"=>[
        ["name"=>"HTML","description"=>"Learn the structure and foundation of modern websites.","icon"=>"🌐"],
        ["name"=>"CSS","description"=>"Style websites and create responsive layouts.","icon"=>"🎨"],
        ["name"=>"JavaScript","description"=>"Add logic and interactivity to websites.","icon"=>"⚡"],
        ["name"=>"Git & GitHub","description"=>"Learn version control and collaboration.","icon"=>"🔀"],
        ["name"=>"Bootstrap / Tailwind","description"=>"Build modern interfaces faster.","icon"=>"🧩"],
        ["name"=>"React / Vue","description"=>"Learn modern frontend frameworks.","icon"=>"⚛️"],
        ["name"=>"APIs","description"=>"Connect frontend applications with backend services.","icon"=>"🔗"]
    ],
    "Backend Development"=>[
        ["name"=>"Programming Fundamentals","description"=>"Understand programming concepts and problem solving.","icon"=>"💡"],
        ["name"=>"Node.js","description"=>"Build server-side applications using JavaScript.","icon"=>"🟢"],
        ["name"=>"Express.js","description"=>"Build APIs and backend applications.","icon"=>"⚙️"],
        ["name"=>"Databases","description"=>"Learn SQL and database fundamentals.","icon"=>"🗄️"],
        ["name"=>"REST APIs","description"=>"Design and consume RESTful APIs.","icon"=>"🔗"],
        ["name"=>"Authentication","description"=>"Learn login, sessions, tokens and authorization.","icon"=>"🔐"],
        ["name"=>"Testing","description"=>"Test backend applications and APIs.","icon"=>"🧪"],
        ["name"=>"Deployment","description"=>"Deploy backend applications online.","icon"=>"☁️"]
    ],
    "Cybersecurity"=>[
        ["name"=>"Computer Fundamentals","description"=>"Understand how computers and operating systems work.","icon"=>"💻"],
        ["name"=>"Networking","description"=>"Learn networks, protocols and communication.","icon"=>"🌐"],
        ["name"=>"Linux","description"=>"Learn Linux commands and system administration.","icon"=>"🐧"],
        ["name"=>"Security Fundamentals","description"=>"Understand basic cybersecurity concepts.","icon"=>"🛡️"],
        ["name"=>"Cryptography","description"=>"Learn encryption and secure communication.","icon"=>"🔑"],
        ["name"=>"Web Security","description"=>"Learn common web vulnerabilities.","icon"=>"🌍"],
        ["name"=>"Ethical Hacking","description"=>"Learn penetration testing fundamentals.","icon"=>"🎯"],
        ["name"=>"Security Projects","description"=>"Practice cybersecurity through real projects.","icon"=>"🚀"]
    ],
    "AI & Machine Learning"=>[
        ["name"=>"Python","description"=>"Learn Python programming for AI and data.","icon"=>"🐍"],
        ["name"=>"Mathematics","description"=>"Learn the mathematical foundations of AI.","icon"=>"📐"],
        ["name"=>"NumPy & Pandas","description"=>"Work with data using Python libraries.","icon"=>"📊"],
        ["name"=>"Statistics","description"=>"Understand statistics for machine learning.","icon"=>"📈"],
        ["name"=>"Machine Learning","description"=>"Build predictive machine learning models.","icon"=>"🤖"],
        ["name"=>"Deep Learning","description"=>"Learn neural networks and deep learning.","icon"=>"🧠"],
        ["name"=>"Generative AI","description"=>"Explore modern generative AI technologies.","icon"=>"✨"],
        ["name"=>"AI Projects","description"=>"Build practical AI projects.","icon"=>"🚀"]
    ],
    "Data Science"=>[
        ["name"=>"Python","description"=>"Learn Python for data science.","icon"=>"🐍"],
        ["name"=>"Statistics","description"=>"Understand statistics and probability.","icon"=>"📈"],
        ["name"=>"NumPy","description"=>"Perform numerical computations with Python.","icon"=>"🔢"],
        ["name"=>"Pandas","description"=>"Analyze and manipulate datasets.","icon"=>"🐼"],
        ["name"=>"Data Cleaning","description"=>"Prepare and clean real-world datasets.","icon"=>"🧹"],
        ["name"=>"Data Visualization","description"=>"Create charts and communicate insights.","icon"=>"📊"],
        ["name"=>"SQL","description"=>"Query and manage relational databases.","icon"=>"🗄️"],
        ["name"=>"Machine Learning","description"=>"Apply machine learning to data.","icon"=>"🤖"]
    ]
];

$trackSlugs=[
    "Frontend Development"=>"frontend",
    "Backend Development"=>"backend",
    "Cybersecurity"=>"cybersecurity",
    "AI & Machine Learning"=>"ai-ml",
    "Data Science"=>"data-science"
];

$searchTerm=trim((string)($_GET["q"]??""));

function escape($value){
    return htmlspecialchars((string)$value,ENT_QUOTES,"UTF-8");
}

$visibleTracks=$tracks;

if($searchTerm!==""){
    $visibleTracks=array_values(array_filter($tracks,function($track)use($searchTerm){
        $text=$track["title"]." ".($track["description"]??"");
        return stripos($text,$searchTerm)!==false;
    }));
}

$totalTracksCount=count($tracks);
?>

<main class="container">
    <section class="hero">
        <h1>Choose the path that will build your future.</h1>
        <p>Explore different technology career paths and start your journey from the basics to becoming job-ready.</p>

        <form method="get" class="search-area d-flex gap-2">
            <div class="input-group search-box">
                <span class="input-group-text search-icon">🔍</span>
                <input type="text" name="q" class="form-control" placeholder="Search for a track..." value="<?=escape($searchTerm)?>">
            </div>
            <button type="submit" class="filter-btn">Filter</button>
        </form>
    </section>

    <section class="tracks-section">
        <div class="eyebrow">
            <span class="dot"></span>
            <?=$totalTracksCount?> Career Tracks
        </div>

        <div class="row g-4">
            <?php if(empty($visibleTracks)): ?>
                <div class="col-12">
                    <div class="empty-message">No tracks match your search.</div>
                </div>
            <?php else: ?>
                <?php foreach($visibleTracks as $track): ?>
                    <?php
                    $steps=$roadmaps[$track["title"]]??[];
                    $roadmapId="roadmap-".$track["id"];
                    $trackSlug=$trackSlugs[$track["title"]]??"";
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="track-card">
                            <div class="track-image">
                                <img src="images/<?=escape($track["image"])?>" alt="<?=escape($track["title"])?>">
                            </div>

                            <div class="track-content">
                                <h3><?=escape($track["title"])?></h3>
                                <p class="desc"><?=escape($track["description"])?></p>
                                <div class="trackcard-buttons d-flex align-items-center gap-3 mt-3">
                                    <button type="button" class="enroll-track <?=in_array((int)$track['id'],$enrolledCourseIds,true)?'enrolled':''?>" data-course-id="<?=$track['id']?>" <?=in_array((int)$track['id'],$enrolledCourseIds,true)?'disabled':''?>><?=in_array((int)$track['id'],$enrolledCourseIds,true)?'Enrolled':'Enroll'?></button>
                                    <a href="Resources-page.php?track=<?= urlencode($trackSlug) ?>#top" class="track-explore-link">Explore
                                    <span>→</span></a>
                                </div>
                                <button class="roadmap" onclick="toggleRoadmap(this)" type="button" data-bs-toggle="collapse" data-bs-target="#<?=escape($roadmapId)?>" aria-expanded="false" aria-controls="<?=escape($roadmapId)?>">
                                    <span>🗺️ View Roadmap</span>
                                    <span class="roadmap-arrow">↓</span>
                                </button>
                            </div>

                            <div class="collapse" id="<?=escape($roadmapId)?>">
                                <div class="roadmap-wrapper">
                                    <div class="roadmap-heading">
                                        <h4><?=escape($track["title"])?> Roadmap</h4>
                                        <span><?=count($steps)?> Steps</span>
                                    </div>

                                    <div class="roadmap-list">
                                        <?php if(empty($steps)): ?>
                                            <div class="p-3">No roadmap available for this track yet.</div>
                                        <?php else: ?>
                                            <?php foreach($steps as $index=>$step): ?>
                                                <a href="Resources-page.php?track=<?=urlencode($trackSlug)?>&step=<?=urlencode($step["name"])?>" class="roadmap-step">
                                                    <div class="step-number"><?=$index+1?></div>
                                                    <div class="step-icon"><?=escape($step["icon"])?></div>

                                                    <div class="step-info">
                                                        <span class="step-title"><?=escape($step["name"])?></span>
                                                        <span class="step-description"><?=escape($step["description"])?></span>
                                                    </div>

                                                    <div class="step-arrow">→</div>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="roadmap-hint">
                                        💡 Click any roadmap step to explore its courses, playlists, articles and practice resources.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="assess-banner d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h3>Not sure which track is right for you?</h3>
            <p>Take a quick assessment and discover the best career path for your skills.</p>
        </div>
        <a href="#" class="btn btn-light assessment-btn">Start Assessment →</a>
    </section>

    <section class="compare-section">
        <div class="compare-title">
            <h2>Compare Tracks</h2>
            <span>Last updated: August 2026</span>
        </div>

        <div class="table-responsive">
            <table class="table compare-table rounded-4 overflow-hidden align-middle">
                <thead>
                    <tr>
                        <th>Track</th>
                        <th>Duration</th>
                        <th>Difficulty</th>
                        <th>Average Salary</th>
                        <th>Open Jobs</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Frontend Development</td>
                        <td>4 Months</td>
                        <td>Beginner</td>
                        <td><span class="badge badge-avg px-2 py-2">15K EGP</span></td>
                        <td>1,240 Jobs</td>
                    </tr>

                    <tr>
                        <td>Backend Development</td>
                        <td>5 Months</td>
                        <td>Intermediate</td>
                        <td><span class="badge badge-avg px-2 py-2">17K EGP</span></td>
                        <td>980 Jobs</td>
                    </tr>

                    <tr>
                        <td>Cybersecurity</td>
                        <td>6 Months</td>
                        <td>Intermediate</td>
                        <td><span class="badge badge-avg px-2 py-2">19K EGP</span></td>
                        <td>640 Jobs</td>
                    </tr>

                    <tr>
                        <td>AI & Machine Learning</td>
                        <td>6 Months</td>
                        <td>Advanced</td>
                        <td><span class="badge badge-avg px-2 py-2">22K EGP</span></td>
                        <td>510 Jobs</td>
                    </tr>

                    <tr>
                        <td>Data Science</td>
                        <td>5 Months</td>
                        <td>Intermediate</td>
                        <td><span class="badge badge-avg px-2 py-2">18K EGP</span></td>
                        <td>720 Jobs</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    try {
        const removed = JSON.parse(localStorage.getItem('techJourneyRemovedCourses') || '[]');

        document.querySelectorAll('.enroll-track').forEach((btn) => {
            if (removed.includes(String(btn.dataset.courseId))) {
                btn.disabled = false;
                btn.textContent = 'Enroll';
                btn.classList.remove('enrolled');
            }
        });

        localStorage.removeItem('techJourneyRemovedCourses');
    } catch (_) {}
});
</script>

<div class="modal fade" id="enrollSuccessModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content student-modal"><div class="success-icon">✓</div><h3>Enrollment Successful!</h3><p>You are now enrolled in this track.</p><button class="modal-action learn-more-btn" data-bs-dismiss="modal">Continue</button></div></div></div><script>document.addEventListener('DOMContentLoaded',()=>{document.querySelectorAll('.enroll-track').forEach(btn=>btn.addEventListener('click',async()=>{if(btn.disabled)return;const fd=new FormData();fd.append('course_id',btn.dataset.courseId);const old=btn.textContent;btn.disabled=true;try{const r=await fetch('enroll.php',{method:'POST',body:fd});const d=await r.json();if(!d.success)throw Error(d.message);btn.textContent='Enrolled';btn.classList.add('enrolled');bootstrap.Modal.getOrCreateInstance(document.getElementById('enrollSuccessModal')).show();}catch(e){btn.disabled=false;btn.textContent=old;alert(e.message);}}));});</script><?php include_once "includes/footer.php"; ?>