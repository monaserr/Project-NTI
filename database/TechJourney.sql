CREATE DATABASE IF NOT EXISTS tech_journey;

USE tech_journey;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    role ENUM('student', 'instructor') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    image VARCHAR(255) DEFAULT NULL
);

CREATE TABLE course_enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE (user_id, course_id)
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    image VARCHAR(255) DEFAULT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE event_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    UNIQUE (user_id, event_id)
);

CREATE TABLE resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT DEFAULT NULL,
    category VARCHAR(100) NOT NULL,
    topic VARCHAR(100) DEFAULT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    icon VARCHAR(100),
    bg VARCHAR(20),
    link VARCHAR(500) NOT NULL,
    badge VARCHAR(100),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO courses (title, description, image) VALUES
(
    'Frontend Development',
    'Learn how to build beautiful, responsive, and interactive websites.',
    'Frontend.jpg'
),
(
    'Backend Development',
    'Build powerful server-side applications, APIs, and database systems.',
    'backend.png'
),
(
    'AI & Machine Learning',
    'Explore AI, machine learning algorithms and build intelligent applications.',
    'aiTrack.jpg'
),
(
    'Cybersecurity',
    'Learn networking, security fundamentals, ethical hacking and web security.',
    'cybersecurityTrack.jpg'
),
(
    'Data Science',
    'Work with data, analysis, visualization and machine learning.',
    'data-science-.jpg'
);

INSERT INTO `resources` (`id`, `course_id`, `category`, `topic`, `title`, `description`, `icon`, `bg`, `link`, `badge`) VALUES
(57, NULL, 'all', 'Computer Fundamentals', 'How Computers Work', 'freeCodeCamp – intro to how computers & the internet work', 'bi-mortarboard-fill', '#7C6CF0', 'https://www.freecodecamp.org/news/tag/computer-science/', 'All'),
(58, NULL, 'all', 'General', 'CS50: Intro to Computer Science', 'Harvard CS50 – the best free start for absolute beginners', 'bi-terminal-fill', '#111827', 'https://cs50.harvard.edu/x/', 'All'),
(59, NULL, 'all', 'General', 'YouTube – Programming Basics', 'Great tutorials and courses for total beginners', 'bi-youtube', '#FF0000', 'https://www.youtube.com', 'All'),
(60, NULL, 'all', 'General', 'MDN Web Docs', 'The best place to learn Web technologies', 'bi-book-half', '#0E9F8E', 'https://developer.mozilla.org', 'Frontend'),
(61, NULL, 'all', 'General', 'freeCodeCamp', 'Learn to code for free. Build projects.', 'bi-code-slash', '#000000', 'https://www.freecodecamp.org', 'All'),
(62, NULL, 'all', 'General', 'DevDocs', 'API Documentation for Developers', 'bi-journal-code', '#111827', 'https://devdocs.io', 'All'),
(63, NULL, 'all', 'General', 'LeetCode', 'Practice coding and prepare for interviews', 'bi-braces-asterisk', '#F7931E', 'https://leetcode.com', 'All'),
(64, NULL, 'all', 'General', 'GitHub', 'Explore projects and open source', 'bi-github', '#000000', 'https://github.com', 'All'),
(65, 1, 'frontend', 'HTML', 'HTML Full Course', 'freeCodeCamp – HTML crash course for beginners', 'bi-filetype-html', '#E44D26', 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAw_t_XWUFbBX-c9MafPk9ji', 'Frontend'),
(66, 1, 'frontend', 'HTML', 'MDN – HTML Docs', 'Official HTML reference and guides', 'bi-book-half', '#0E9F8E', 'https://developer.mozilla.org/en-US/docs/Web/HTML', 'Frontend'),
(67, 1, 'frontend', 'CSS', 'CSS Full Course', 'YouTube – CSS from zero to advanced', 'bi-filetype-css', '#2965F1', 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAzjsz06gkzlSrlev53MGIKe', 'Frontend'),
(68, 1, 'frontend', 'CSS', 'Flexbox & Grid', 'CSS-Tricks – complete guides to Flexbox and Grid', 'bi-grid-3x3-gap-fill', '#7C6CF0', 'https://css-tricks.com/snippets/css/a-guide-to-flexbox/', 'Frontend'),
(69, 1, 'frontend', 'JavaScript', 'JavaScript Full Course', 'freeCodeCamp – JS fundamentals for beginners', 'bi-filetype-js', '#F0DB4F', 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAx3kiplQR_oeDqLDBUDYwVv', 'Frontend'),
(70, 1, 'frontend', 'JavaScript', 'MDN – JavaScript Docs', 'Official JavaScript reference and guides', 'bi-book-half', '#0E9F8E', 'https://developer.mozilla.org/en-US/docs/Web/JavaScript', 'Frontend'),
(71, 1, 'frontend', 'Frameworks & Tools', 'Git & GitHub for Frontend', 'Version control basics every frontend dev needs', 'bi-github', '#000000', 'https://www.youtube.com/playlist?list=PLDoPjvoNmBAw4eOj58MZPakHjaO3frVMF', 'Frontend'),
(72, 1, 'frontend', 'Frameworks & Tools', 'Bootstrap Crash Course', 'Learn to build responsive UIs fast with Bootstrap', 'bi-bootstrap-fill', '#7C6CF0', 'https://youtu.be/-qfEOE4vtxE', 'Frontend'),
(73, 1, 'frontend', 'JavaScript Frameworks', 'React – Beginner\'s Tutorial', 'freeCodeCamp – learn React by building real projects', 'bi-app-indicator', '#61DAFB', 'https://www.youtube.com/playlist?list=PLYyqC4bNbCIdSZ-JayMLl4WO2Cr995vyS', 'Frontend'),
(74, 1, 'frontend', 'JavaScript Frameworks', 'Vue.js – Full Course for Beginners', 'Learn Vue.js from scratch', 'bi-triangle-fill', '#42B883', 'https://www.youtube.com/@ElzeroWebSchool', 'Frontend'),
(75, 1, 'frontend', 'APIs', 'Frontend APIs', 'Learn how frontend applications communicate with APIs', 'bi-api', '#61DAFB', 'https://www.freecodecamp.org/news/tag/api/', 'Frontend'),
(76, 2, 'backend', 'Programming Fundamentals', 'CS50: Intro to CS', 'Harvard CS50 – strong foundation before backend', 'bi-terminal-fill', '#111827', 'https://cs50.harvard.edu/x/', 'Backend'),
(77, 2, 'backend', 'Node.js', 'Node.js Full Course', 'freeCodeCamp – Node.js from scratch', 'bi-node-plus-fill', '#3C873A', 'https://www.youtube.com/results?search_query=nodejs+full+course', 'Backend'),
(78, 2, 'backend', 'Node.js', 'Node.js Docs', 'Official Node.js documentation', 'bi-book-half', '#0E9F8E', 'https://nodejs.org/en/docs/', 'Backend'),
(79, 2, 'backend', 'Express.js', 'Express.js Crash Course', 'Build APIs and servers with Express', 'bi-diagram-3-fill', '#111827', 'https://www.youtube.com/results?search_query=express+js+crash+course', 'Backend'),
(80, 2, 'backend', 'Express.js', 'Express.js Docs', 'Official Express.js documentation', 'bi-book-half', '#0E9F8E', 'https://expressjs.com/', 'Backend'),
(81, 2, 'backend', 'Databases', 'MySQL Full Course', 'Learn SQL and relational database design', 'bi-database-fill', '#00758F', 'https://www.youtube.com/results?search_query=mysql+full+course', 'Backend'),
(82, 2, 'backend', 'Databases', 'MongoDB Crash Course', 'Learn NoSQL databases with MongoDB', 'bi-database', '#4479A1', 'https://www.youtube.com/results?search_query=mongodb+crash+course', 'Backend'),
(83, 2, 'backend', 'APIs', 'Building REST APIs', 'How to design and build RESTful APIs', 'bi-diagram-3-fill', '#7C6CF0', 'https://www.freecodecamp.org/news/tag/api/', 'Backend'),
(84, 2, 'backend', 'APIs', 'API Authentication', 'Learn JWT and session-based authentication', 'bi-shield-check', '#DC2626', 'https://www.youtube.com/results?search_query=jwt+authentication+nodejs', 'Backend'),
(85, 4, 'cybersecurity', 'Computer Fundamentals', 'How Computers Work', 'Computer and operating system fundamentals', 'bi-pc-display', '#111827', 'https://www.youtube.com/results?search_query=how+computers+and+operating+systems+work', 'Cybersecurity'),
(86, 4, 'cybersecurity', 'Networking', 'Networking Fundamentals', 'Learn networking fundamentals', 'bi-router-fill', '#111827', 'https://www.youtube.com/results?search_query=networking+fundamentals+freecodecamp', 'Cybersecurity'),
(87, 4, 'cybersecurity', 'Linux', 'Linux Full Course', 'Learn Linux commands and system administration', 'bi-terminal-fill', '#F7931E', 'https://www.youtube.com/results?search_query=linux+full+course+for+beginners', 'Cybersecurity'),
(88, 4, 'cybersecurity', 'Security Fundamentals', 'Cybersecurity Fundamentals', 'Understand the basic concepts of cybersecurity', 'bi-shield-fill-check', '#7C6CF0', 'https://www.youtube.com/results?search_query=cybersecurity+fundamentals+course', 'Cybersecurity'),
(89, 4, 'cybersecurity', 'Cryptography', 'Cryptography Crash Course', 'Learn encryption and secure communication basics', 'bi-key-fill', '#0E9F8E', 'https://www.youtube.com/results?search_query=cryptography+crash+course', 'Cybersecurity'),
(90, 4, 'cybersecurity', 'Web Security', 'OWASP Top 10', 'Learn the most common web vulnerabilities', 'bi-globe2', '#00758F', 'https://owasp.org/www-project-top-ten/', 'Cybersecurity'),
(91, 4, 'cybersecurity', 'Ethical Hacking', 'TryHackMe – Beginner Path', 'Hands-on labs to learn practical cybersecurity', 'bi-shield-lock-fill', '#111827', 'https://tryhackme.com', 'Cybersecurity'),
(92, 4, 'cybersecurity', 'Ethical Hacking', 'HackTheBox', 'Practice real-world penetration testing', 'bi-bug-fill', '#DC2626', 'https://www.hackthebox.com', 'Cybersecurity'),
(93, 4, 'cybersecurity', 'Security Projects', 'Cybersecurity Projects', 'Practice cybersecurity through real hands-on projects', 'bi-rocket-takeoff-fill', '#7C6CF0', 'https://www.hackthebox.com', 'Cybersecurity'),
(94, 3, 'ai-ml', 'Python', 'Python for AI', 'Python basics before Machine Learning', 'bi-filetype-py', '#3776AB', 'https://www.youtube.com/results?search_query=python+for+ai+freecodecamp', 'AI'),
(95, 3, 'ai-ml', 'Mathematics', 'Math for Machine Learning', 'Linear algebra, calculus and probability foundations', 'bi-calculator-fill', '#7C6CF0', 'https://www.youtube.com/results?search_query=math+for+machine+learning+course', 'AI'),
(96, 3, 'ai-ml', 'NumPy & Pandas', 'NumPy & Pandas Course', 'Work with data using Python libraries', 'bi-table', '#111827', 'https://www.youtube.com/results?search_query=numpy+pandas+full+course', 'AI'),
(97, 3, 'ai-ml', 'Statistics', 'Statistics for Machine Learning', 'Understand statistics before diving into ML', 'bi-bar-chart-fill', '#0E9F8E', 'https://www.khanacademy.org/math/statistics-probability', 'AI'),
(98, 3, 'ai-ml', 'Machine Learning', 'Machine Learning Course', 'Andrew Ng – Machine Learning Specialization', 'bi-cpu-fill', '#7C6CF0', 'https://www.coursera.org/specializations/machine-learning-introduction', 'AI'),
(99, 3, 'ai-ml', 'Deep Learning', 'Deep Learning Specialization', 'DeepLearning.AI – neural networks in depth', 'bi-diagram-2-fill', '#111827', 'https://www.coursera.org/specializations/deep-learning', 'AI'),
(100, 3, 'ai-ml', 'Generative AI', 'Generative AI Explained', 'Explore modern generative AI technologies', 'bi-stars', '#DC2626', 'https://www.youtube.com/results?search_query=generative+ai+course', 'AI'),
(101, 3, 'ai-ml', 'AI Projects', 'AI Practice Projects', 'Build practical AI projects', 'bi-rocket-takeoff-fill', '#00758F', 'https://www.kaggle.com/competitions', 'AI'),
(102, 5, 'data-science', 'Python', 'Python for Data Science', 'Python basics for data science', 'bi-filetype-py', '#3776AB', 'https://www.youtube.com/results?search_query=python+for+data+science+freecodecamp', 'Data Science'),
(103, 5, 'data-science', 'Statistics', 'Statistics Fundamentals', 'Statistics for data science', 'bi-bar-chart-fill', '#7C6CF0', 'https://www.khanacademy.org/math/statistics-probability', 'Data Science'),
(104, 5, 'data-science', 'NumPy', 'NumPy Crash Course', 'Perform numerical computations with Python', 'bi-grid-3x3-gap-fill', '#111827', 'https://www.youtube.com/results?search_query=numpy+crash+course', 'Data Science'),
(105, 5, 'data-science', 'Pandas', 'Pandas Full Course', 'Analyze and manipulate datasets with Pandas', 'bi-table', '#0E9F8E', 'https://www.youtube.com/results?search_query=pandas+full+course', 'Data Science'),
(106, 5, 'data-science', 'Data Cleaning', 'Data Cleaning Guide', 'Prepare and clean real-world datasets', 'bi-eraser-fill', '#DC2626', 'https://www.youtube.com/results?search_query=data+cleaning+with+pandas', 'Data Science'),
(107, 5, 'data-science', 'Data Visualization', 'Data Visualization', 'Learn to visualize and communicate insights', 'bi-graph-up', '#0E9F8E', 'https://www.kaggle.com/learn/data-visualization', 'Data Science'),
(108, 5, 'data-science', 'SQL', 'SQL Full Course', 'Query and manage relational databases', 'bi-database-fill', '#00758F', 'https://www.youtube.com/results?search_query=sql+full+course', 'Data Science'),
(109, 5, 'data-science', 'Machine Learning', 'Machine Learning for Data Science', 'Apply machine learning to real data', 'bi-cpu-fill', '#7C6CF0', 'https://www.coursera.org/specializations/machine-learning-introduction', 'Data Science');
