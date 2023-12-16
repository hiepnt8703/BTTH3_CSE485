CREATE TABLE users (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
CREATE TABLE courses (
    id INT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
CREATE TABLE course_user (
    course_id INT,
    user_id INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE lessons (
    id INT PRIMARY KEY,
    course_id INT,
    title VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
CREATE TABLE materials (
    id INT PRIMARY KEY,
    lesson_id INT,
    title VARCHAR(255),
    file_path VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id)
);
CREATE TABLE quizzes (
    id INT PRIMARY KEY,
    lesson_id INT,
    title VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id)
);
CREATE TABLE questions (
    id INT PRIMARY KEY,
    quiz_id INT,
    question TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id)
);
CREATE TABLE options (
    id INT PRIMARY KEY,
    question_id INT,
    option TEXT,
    is_correct BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES questions(id)
);
INSERT INTO users (id, name, email, password, created_at, updated_at)
VALUES (1, 'John Doe', 'john.doe@example.com', 'hashed_password', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 'Jane Smith', 'jane.smith@example.com', 'hashed_password', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO courses (id, title, description, created_at, updated_at)
VALUES (1, 'Introduction to Programming', 'Learn the basics of programming.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 'Database Management', 'Explore database concepts and management.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO course_user (course_id, user_id, created_at, updated_at)
VALUES (1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (1, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO lessons (id, course_id, title, description, created_at, updated_at)
VALUES (1, 1, 'Introduction to Programming Concepts', 'Overview of programming fundamentals.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 1, 'Data Types and Variables', 'Understanding data types and variables.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 2, 'Introduction to Database Design', 'Fundamentals of designing a database.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO materials (id, lesson_id, title, file_path, created_at, updated_at)
VALUES (1, 1, 'Programming Concepts Slides', '/path/to/slides.pdf', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 2, 'Data Types Cheat Sheet', '/path/to/cheat_sheet.pdf', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO quizzes (id, lesson_id, title, created_at, updated_at)
VALUES (1, 2, 'Data Types Quiz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 3, 'Database Design Quiz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO questions (id, quiz_id, question, created_at, updated_at)
VALUES (1, 1, 'What is a string?', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 1, 'How to declare an integer variable?', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 2, 'What is a primary key?', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO options (id, question_id, option, is_correct, created_at, updated_at)
VALUES (1, 1, 'A sequence of characters', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 1, 'A whole number', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 2, 'int x;', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (4, 2, 'string name;', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (5, 3, 'A unique identifier for a record in a table', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (6, 3, 'A data type for storing dates', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
