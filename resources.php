<?php
$pageTitle = "Resources";
include_once("includes/navbar.php");
?>

<?php

$categories = [
    'all'            => 'All',
    'frontend'       => 'Frontend',
    'backend'        => 'Backend',
    'cybersecurity'  => 'Cybersecurity',
    'ai-ml'          => 'AI',
    'data-science'   => 'Data Science',
];

$resources = [

    'all' => [
        'group' => null,
        'items' => [
            ['icon' => 'bi-mortarboard-fill', 'bg' => '#7C6CF0', 'title' => 'How Computers Work', 'desc' => 'freeCodeCamp – intro to how computers & the internet work', 'link' => 'https://www.freecodecamp.org/news/tag/computer-science/', 'badge' => 'All'],
            ['icon' => 'bi-terminal-fill',    'bg' => '#111827', 'title' => 'CS50: Intro to Computer Science', 'desc' => 'Harvard CS50 – the best free start for absolute beginners', 'link' => 'https://cs50.harvard.edu/x/', 'badge' => 'All'],
            ['icon' => 'bi-youtube',          'bg' => '#FF0000', 'title' => 'YouTube – Programming Basics', 'desc' => 'Great tutorials and courses for total beginners', 'link' => 'https://www.youtube.com', 'badge' => 'All'],
            ['icon' => 'bi-book-half',        'bg' => '#0E9F8E', 'title' => 'MDN Web Docs', 'desc' => 'The best place to learn Web technologies', 'link' => 'https://developer.mozilla.org', 'badge' => 'Frontend'],
            ['icon' => 'bi-code-slash',       'bg' => '#000000', 'title' => 'freeCodeCamp', 'desc' => 'Learn to code for free. Build projects.', 'link' => 'https://www.freecodecamp.org', 'badge' => 'All'],
            ['icon' => 'bi-journal-code',     'bg' => '#111827', 'title' => 'DevDocs', 'desc' => 'API Documentation for Developers', 'link' => 'https://devdocs.io', 'badge' => 'All'],
            ['icon' => 'bi-braces-asterisk',  'bg' => '#F7931E', 'title' => 'LeetCode', 'desc' => 'Practice coding and prepare for interviews', 'link' => 'https://leetcode.com', 'badge' => 'All'],
            ['icon' => 'bi-github',           'bg' => '#000000', 'title' => 'GitHub', 'desc' => 'Explore projects and open source', 'link' => 'https://github.com', 'badge' => 'All'],
        ],
    ],

    'frontend' => [
        'roadmap' => [
            'HTML' => [
                ['icon' => 'bi-filetype-html', 'bg' => '#E44D26', 'title' => 'HTML Full Course', 'desc' => 'freeCodeCamp – HTML crash course for beginners', 'link' => 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAw_t_XWUFbBX-c9MafPk9ji', 'badge' => 'Frontend'],
                ['icon' => 'bi-book-half',     'bg' => '#0E9F8E', 'title' => 'MDN – HTML Docs', 'desc' => 'Official HTML reference and guides', 'link' => 'https://developer.mozilla.org/en-US/docs/Web/HTML', 'badge' => 'Frontend'],
            ],
            'CSS' => [
                ['icon' => 'bi-filetype-css', 'bg' => '#2965F1', 'title' => 'CSS Full Course', 'desc' => 'YouTube – CSS from zero to advanced', 'link' => 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAzjsz06gkzlSrlev53MGIKe', 'badge' => 'Frontend'],
                ['icon' => 'bi-grid-3x3-gap-fill', 'bg' => '#7C6CF0', 'title' => 'Flexbox & Grid', 'desc' => 'CSS-Tricks – complete guides to Flexbox and Grid', 'link' => 'https://css-tricks.com/snippets/css/a-guide-to-flexbox/', 'badge' => 'Frontend'],
            ],
            'JavaScript' => [
                ['icon' => 'bi-filetype-js',  'bg' => '#F0DB4F', 'title' => 'JavaScript Full Course', 'desc' => 'freeCodeCamp – JS fundamentals for beginners', 'link' => 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAx3kiplQR_oeDqLDBUDYwVv', 'badge' => 'Frontend'],
                ['icon' => 'bi-book-half',    'bg' => '#0E9F8E', 'title' => 'MDN – JavaScript Docs', 'desc' => 'Official JavaScript reference and guides', 'link' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript', 'badge' => 'Frontend'],
            ],
            'Frameworks & Tools' => [
                ['icon' => 'bi-github',        'bg' => '#000000', 'title' => 'Git & GitHub for Frontend', 'desc' => 'Version control basics every frontend dev needs', 'link' => 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAw4eOj58MZPakHjaO3frVMF', 'badge' => 'Frontend'],
                ['icon' => 'bi-bootstrap-fill', 'bg' => '#7C6CF0', 'title' => 'Bootstrap Crash Course', 'desc' => 'Learn to build responsive UIs fast with Bootstrap', 'link' => 'https://youtu.be/-qfEOE4vtxE?si=Sg7BibxhFFe0S7RY', 'badge' => 'Frontend'],

            ],
             'JavaScript Frameworks' => [
                ['icon' => 'bi-app-indicator', 'bg' => '#61DAFB', 'title' => 'React – Beginner\'s Tutorial', 'desc' => 'freeCodeCamp – learn React by building real projects (video)', 'link' => 'https://www.youtube.com/playlist?list=PLYyqC4bNbCIdSZ-JayMLl4WO2Cr995vyS', 'badge' => 'Frontend'],
                ['icon' => 'bi-triangle-fill', 'bg' => '#42B883', 'title' => 'Vue.js – Full Course for Beginners', 'desc' => 'freeCodeCamp – learn Vue.js from scratch (video)', 'link' => 'https://www.youtube.com/@ElzeroWebSchool', 'badge' => 'Frontend'],
        ],
        'APIs' => [
                ['icon' => 'bi-api', 'bg' => '#61DAFB', 'title' => 'React – Beginner\'s Tutorial', 'desc' => 'freeCodeCamp – learn React by building real projects (video)', 'link' => 'https://www.youtube.com/playlist?list=PLYyqC4bNbCIdSZ-JayMLl4WO2Cr995vyS', 'badge' => 'Frontend'],
        ],
        ],
    ],

    'backend' => [
        'roadmap' => [
            'Programming Fundamentals' => [
                ['icon' => 'bi-terminal-fill', 'bg' => '#111827', 'title' => 'CS50: Intro to CS', 'desc' => 'Harvard CS50 – strong foundation before backend', 'link' => 'https://cs50.harvard.edu/x/', 'badge' => 'Backend'],
            ],
            'Node.js' => [
                ['icon' => 'bi-node-plus-fill', 'bg' => '#3C873A', 'title' => 'Node.js Full Course', 'desc' => 'freeCodeCamp – Node.js from scratch', 'link' => 'https://www.youtube.com/results?search_query=nodejs+full+course', 'badge' => 'Backend'],
                ['icon' => 'bi-book-half', 'bg' => '#0E9F8E', 'title' => 'Node.js Docs', 'desc' => 'Official Node.js documentation', 'link' => 'https://nodejs.org/en/docs/', 'badge' => 'Backend'],
            ],
            'Express.js' => [
                ['icon' => 'bi-diagram-3-fill', 'bg' => '#111827', 'title' => 'Express.js Crash Course', 'desc' => 'Build APIs and servers with Express', 'link' => 'https://www.youtube.com/results?search_query=express+js+crash+course', 'badge' => 'Backend'],
                ['icon' => 'bi-book-half', 'bg' => '#0E9F8E', 'title' => 'Express.js Docs', 'desc' => 'Official Express.js documentation', 'link' => 'https://expressjs.com/', 'badge' => 'Backend'],
            ],
            'Databases' => [
                ['icon' => 'bi-database-fill', 'bg' => '#00758F', 'title' => 'MySQL Full Course', 'desc' => 'Learn SQL and relational database design', 'link' => 'https://www.youtube.com/results?search_query=mysql+full+course', 'badge' => 'Backend'],
                ['icon' => 'bi-database', 'bg' => '#4479A1', 'title' => 'MongoDB Crash Course', 'desc' => 'Learn NoSQL databases with MongoDB', 'link' => 'https://www.youtube.com/results?search_query=mongodb+crash+course', 'badge' => 'Backend'],
            ],
            'APIs' => [
                ['icon' => 'bi-diagram-3-fill', 'bg' => '#7C6CF0', 'title' => 'Building REST APIs', 'desc' => 'How to design and build RESTful APIs', 'link' => 'https://www.freecodecamp.org/news/tag/api/', 'badge' => 'Backend'],
                ['icon' => 'bi-shield-check', 'bg' => '#DC2626', 'title' => 'API Authentication', 'desc' => 'Learn JWT and session-based authentication', 'link' => 'https://www.youtube.com/results?search_query=jwt+authentication+nodejs', 'badge' => 'Backend'],
            ],
        ],
    ],

    'cybersecurity' => [
        'roadmap' => [
            'Computer Fundamentals' => [
                ['icon' => 'bi-pc-display', 'bg' => '#111827', 'title' => 'How Computers Work', 'desc' => 'freeCodeCamp – operating systems & computer fundamentals', 'link' => 'https://www.youtube.com/results?search_query=how+computers+and+operating+systems+work', 'badge' => 'Cybersecurity'],
            ],
            'Networking' => [
                ['icon' => 'bi-router-fill', 'bg' => '#111827', 'title' => 'Networking Fundamentals', 'desc' => 'freeCodeCamp – networking crash course', 'link' => 'https://www.youtube.com/results?search_query=networking+fundamentals+freecodecamp', 'badge' => 'Cybersecurity'],
            ],
            'Linux' => [
                ['icon' => 'bi-terminal-fill', 'bg' => '#F7931E', 'title' => 'Linux Full Course', 'desc' => 'Learn Linux commands and system administration', 'link' => 'https://www.youtube.com/results?search_query=linux+full+course+for+beginners', 'badge' => 'Cybersecurity'],
            ],
            'Security Fundamentals' => [
                ['icon' => 'bi-shield-fill-check', 'bg' => '#7C6CF0', 'title' => 'Cybersecurity Fundamentals', 'desc' => 'Understand the basic concepts of cybersecurity', 'link' => 'https://www.youtube.com/results?search_query=cybersecurity+fundamentals+course', 'badge' => 'Cybersecurity'],
            ],
            'Cryptography' => [
                ['icon' => 'bi-key-fill', 'bg' => '#0E9F8E', 'title' => 'Cryptography Crash Course', 'desc' => 'Learn encryption and secure communication basics', 'link' => 'https://www.youtube.com/results?search_query=cryptography+crash+course', 'badge' => 'Cybersecurity'],
            ],
            'Web Security' => [
                ['icon' => 'bi-globe2', 'bg' => '#00758F', 'title' => 'OWASP Top 10', 'desc' => 'Learn the most common web vulnerabilities', 'link' => 'https://owasp.org/www-project-top-ten/', 'badge' => 'Cybersecurity'],
            ],
            'Ethical Hacking' => [
                ['icon' => 'bi-shield-lock-fill', 'bg' => '#111827', 'title' => 'TryHackMe – Beginner Path', 'desc' => 'Hands-on labs to learn practical cybersecurity', 'link' => 'https://tryhackme.com', 'badge' => 'Cybersecurity'],
                ['icon' => 'bi-bug-fill', 'bg' => '#DC2626', 'title' => 'HackTheBox', 'desc' => 'Practice real-world penetration testing', 'link' => 'https://www.hackthebox.com', 'badge' => 'Cybersecurity'],
            ],
            'Security Projects' => [
                ['icon' => 'bi-rocket-takeoff-fill', 'bg' => '#7C6CF0', 'title' => 'Cybersecurity Projects', 'desc' => 'Practice cybersecurity through real hands-on projects', 'link' => 'https://www.hackthebox.com', 'badge' => 'Cybersecurity'],
            ],
        ],
    ],

    'ai-ml' => [
        'roadmap' => [
            'Python' => [
                ['icon' => 'bi-filetype-py', 'bg' => '#3776AB', 'title' => 'Python for AI', 'desc' => 'freeCodeCamp – Python basics before ML', 'link' => 'https://www.youtube.com/results?search_query=python+for+ai+freecodecamp', 'badge' => 'AI'],
            ],
            'Mathematics' => [
                ['icon' => 'bi-calculator-fill', 'bg' => '#7C6CF0', 'title' => 'Math for Machine Learning', 'desc' => 'Linear algebra, calculus & probability foundations for AI', 'link' => 'https://www.youtube.com/results?search_query=math+for+machine+learning+course', 'badge' => 'AI'],
            ],
            'NumPy & Pandas' => [
                ['icon' => 'bi-table', 'bg' => '#111827', 'title' => 'NumPy & Pandas Course', 'desc' => 'Work with data using Python libraries', 'link' => 'https://www.youtube.com/results?search_query=numpy+pandas+full+course', 'badge' => 'AI'],
            ],
            'Statistics' => [
                ['icon' => 'bi-bar-chart-fill', 'bg' => '#0E9F8E', 'title' => 'Statistics for Machine Learning', 'desc' => 'Understand statistics before diving into ML', 'link' => 'https://www.khanacademy.org/math/statistics-probability', 'badge' => 'AI'],
            ],
            'Machine Learning' => [
                ['icon' => 'bi-cpu-fill', 'bg' => '#7C6CF0', 'title' => 'Machine Learning Course', 'desc' => 'Andrew Ng – Machine Learning Specialization', 'link' => 'https://www.coursera.org/specializations/machine-learning-introduction', 'badge' => 'AI'],
            ],
            'Deep Learning' => [
                ['icon' => 'bi-diagram-2-fill', 'bg' => '#111827', 'title' => 'Deep Learning Specialization', 'desc' => 'DeepLearning.AI – neural networks in depth', 'link' => 'https://www.coursera.org/specializations/deep-learning', 'badge' => 'AI'],
            ],
            'Generative AI' => [
                ['icon' => 'bi-stars', 'bg' => '#DC2626', 'title' => 'Generative AI Explained', 'desc' => 'Explore modern generative AI technologies', 'link' => 'https://www.youtube.com/results?search_query=generative+ai+course', 'badge' => 'AI'],
            ],
            'AI Projects' => [
                ['icon' => 'bi-rocket-takeoff-fill', 'bg' => '#00758F', 'title' => 'AI Practice Projects', 'desc' => 'Build practical AI projects to apply what you learned', 'link' => 'https://www.kaggle.com/competitions', 'badge' => 'AI'],
            ],
        ],
    ],

    'data-science' => [
        'roadmap' => [
            'Python' => [
                ['icon' => 'bi-filetype-py', 'bg' => '#3776AB', 'title' => 'Python for Data Science', 'desc' => 'freeCodeCamp – Python basics for data work', 'link' => 'https://www.youtube.com/results?search_query=python+for+data+science+freecodecamp', 'badge' => 'Data Science'],
            ],
            'Statistics' => [
                ['icon' => 'bi-bar-chart-fill', 'bg' => '#7C6CF0', 'title' => 'Statistics Fundamentals', 'desc' => 'Khan Academy – statistics for data science', 'link' => 'https://www.khanacademy.org/math/statistics-probability', 'badge' => 'Data Science'],
            ],
            'NumPy' => [
                ['icon' => 'bi-grid-3x3-gap-fill', 'bg' => '#111827', 'title' => 'NumPy Crash Course', 'desc' => 'Perform numerical computations with Python', 'link' => 'https://www.youtube.com/results?search_query=numpy+crash+course', 'badge' => 'Data Science'],
            ],
            'Pandas' => [
                ['icon' => 'bi-table', 'bg' => '#0E9F8E', 'title' => 'Pandas Full Course', 'desc' => 'Analyze and manipulate datasets with Pandas', 'link' => 'https://www.youtube.com/results?search_query=pandas+full+course', 'badge' => 'Data Science'],
            ],
            'Data Cleaning' => [
                ['icon' => 'bi-eraser-fill', 'bg' => '#DC2626', 'title' => 'Data Cleaning Guide', 'desc' => 'Prepare and clean real-world datasets', 'link' => 'https://www.youtube.com/results?search_query=data+cleaning+with+pandas', 'badge' => 'Data Science'],
            ],
            'Data Visualization' => [
                ['icon' => 'bi-graph-up', 'bg' => '#0E9F8E', 'title' => 'Data Visualization', 'desc' => 'Kaggle – learn to visualize and tell stories with data', 'link' => 'https://www.kaggle.com/learn/data-visualization', 'badge' => 'Data Science'],
            ],
            'SQL' => [
                ['icon' => 'bi-database-fill', 'bg' => '#00758F', 'title' => 'SQL Full Course', 'desc' => 'Query and manage relational databases', 'link' => 'https://www.youtube.com/results?search_query=sql+full+course', 'badge' => 'Data Science'],
            ],
            'Machine Learning' => [
                ['icon' => 'bi-cpu-fill', 'bg' => '#7C6CF0', 'title' => 'Machine Learning for Data Science', 'desc' => 'Apply machine learning to real data', 'link' => 'https://www.coursera.org/specializations/machine-learning-introduction', 'badge' => 'Data Science'],
            ],
        ],
    ],
];

// which track to open by default (also read + honored by JS from the URL)
$initialTrack = isset($_GET['track']) && array_key_exists($_GET['track'], $categories)
    ? $_GET['track']
    : 'all';
?>


<!-- Navbar -->
<nav class="pf-navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="index.php" class="d-flex align-items-center text-decoration-none gap-2">
            <span class="pf-logo-icon"><i class="bi bi-signpost-split-fill"></i></span>
            <span class="pf-logo-text">Tech Journey</span>
        </a>
        <div class="d-none d-lg-flex align-items-center">
            <a href="index.php" class="pf-nav-link text-decoration-none">Home</a>
            <a href="tracks.php" class="pf-nav-link text-decoration-none">Tracks</a>
            <a href="challenges.php" class="pf-nav-link text-decoration-none">Challenges</a>
            <a href="resource-page.php" class="pf-nav-link active text-decoration-none">Resources</a>
            <a href="events.php" class="pf-nav-link text-decoration-none">Events</a>
            <a href="about.php" class="pf-nav-link text-decoration-none">About</a>
        </div>
        <a href="login.php" class="pf-login-btn text-decoration-none">Login</a>
    </div>
</nav>

<!-- Header -->
<div class="container mt-4">
    <h2 class="pf-page-title">Resources</h2>
    <p class="pf-page-subtitle">Curated resources to help you learn better</p>

    <!-- Filters -->
    <div class="d-flex flex-wrap gap-2 my-4" id="pf-filters">
        <?php foreach ($categories as $slug => $label): ?>
            <button type="button"
                    class="pf-filter-btn <?= $slug === $initialTrack ? 'active' : '' ?>"
                    data-filter="<?= htmlspecialchars($slug) ?>">
                <?= htmlspecialchars($label) ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Resource lists (one block per category, JS toggles visibility) -->
    <div id="pf-resource-container" class="pb-5">

        <!-- ALL -->
        <div class="pf-track-section" data-section="all" style="<?= $initialTrack === 'all' ? '' : 'display:none;' ?>">
            <?php foreach ($resources['all']['items'] as $item): ?>
                <?php include __DIR__ . '/resource_row.php'; ?>
            <?php endforeach; ?>
        </div>

        <!-- OTHER TRACKS (roadmap style, grouped by topic) -->
        <?php foreach ($resources as $slug => $data): ?>
            <?php if ($slug === 'all') continue; ?>
            <div class="pf-track-section" data-section="<?= htmlspecialchars($slug) ?>" style="<?= $initialTrack === $slug ? '' : 'display:none;' ?>">
                <?php foreach ($data['roadmap'] as $groupName => $items): ?>
                    <div class="pf-group-title">
                        <i class="bi bi-map-fill"></i><?= htmlspecialchars($groupName) ?>
                    </div>
                    <?php foreach ($items as $item): ?>
                        <?php include __DIR__ . '/resource_row.php'; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php
include_once 'includes/footer.php';
?>
