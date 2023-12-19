-- Tạo bảng users
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng courses
CREATE TABLE courses (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng course_user
CREATE TABLE course_user (
    course_id INTEGER REFERENCES courses(id),
    user_id INTEGER REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (course_id, user_id)
);

-- Tạo bảng lessons
CREATE TABLE lessons (
    id SERIAL PRIMARY KEY,
    course_id INTEGER REFERENCES courses(id),
    title VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng materials
CREATE TABLE materials (
    id SERIAL PRIMARY KEY,
    lesson_id INTEGER REFERENCES lessons(id),
    title VARCHAR(255),
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng quizzes
CREATE TABLE quizzes (
    id SERIAL PRIMARY KEY,
    lesson_id INTEGER REFERENCES lessons(id),
    title VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng questions
CREATE TABLE questions (
    id SERIAL PRIMARY KEY,
    quiz_id INTEGER REFERENCES quizzes(id),
    question TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng options
CREATE TABLE options (
    id SERIAL PRIMARY KEY,
    question_id INTEGER REFERENCES questions(id),
    option TEXT,
    is_correct BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Thêm người dùng
INSERT INTO users (name, email, password) VALUES
('User1', 'user1@email.com', 'password1'),
('User2', 'user2@email.com', 'password2');

-- Thêm khóa học
INSERT INTO courses (title, description) VALUES
('Course1', 'Description for Course1'),
('Course2', 'Description for Course2');

-- Thêm mối quan hệ người dùng - khóa học
INSERT INTO course_user (course_id, user_id) VALUES
(1, 1),
(1, 2),
(2, 1);

-- Thêm bài học
INSERT INTO lessons (course_id, title, description) VALUES
(1, 'Lesson1', 'Description for Lesson1'),
(1, 'Lesson2', 'Description for Lesson2'),
(2, 'Lesson1', 'Description for Lesson1');

-- Thêm tài nguyên học tập
INSERT INTO materials (lesson_id, title, file_path) VALUES
(1, 'Material1', '/path/to/material1.pdf'),
(1, 'Material2', '/path/to/material2.pdf'),
(2, 'Material1', '/path/to/material1_course2.pdf');

-- Thêm bài kiểm tra (quiz)
INSERT INTO quizzes (lesson_id, title) VALUES
(1, 'Quiz1'),
(2, 'Quiz2');

-- Thêm câu hỏi
INSERT INTO questions (quiz_id, question) VALUES
(1, 'What is the capital of Country1?'),
(1, 'Who wrote Book1?'),
(2, 'What is the main concept of Lesson2?');

-- Thêm tùy chọn cho câu hỏi
INSERT INTO options (question_id, option, is_correct) VALUES
(1, 'Option1', true),
(1, 'Option2', false),
(1, 'Option3', false),
(2, 'Option1', false),
(2, 'Option2', true),
(2, 'Option3', false),
(3, 'Option1', true),
(3, 'Option2', false),
(3, 'Option3', false);
