CREATE DATABASE IF NOT EXISTS library_makie;
USE library_makie;

CREATE TABLE IF NOT EXISTS students(
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_first_name VARCHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,
    student_course VARCHAR(50) NOT NULL,
    student_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books(
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_title VARCHAR(100) NOT NULL,
    book_author VARCHAR(100) NOT NULL,
    book_category VARCHAR(50) NOT NULL,
    book_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS borrow(
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date TIMESTAMP NULL DEFAULT NULL,
    borrow_due_date TIMESTAMP NULL DEFAULT NULL,
    borrow_return_date TIMESTAMP NULL DEFAULT NULL
);
