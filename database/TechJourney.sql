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