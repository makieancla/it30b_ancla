-- #1 students table
CREATE TABLE IF NOT EXISTS students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    student_first_name VARCHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,
    student_course VARCHAR(50) NOT NULL,
    student_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- #2 books table
CREATE TABLE IF NOT EXISTS books (
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    book_title VARCHAR(100) NOT NULL,
    book_author VARCHAR(100) NOT NULL,
    book_category VARCHAR(50) NOT NULL,
    book_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- #3 borrow table
CREATE TABLE IF NOT EXISTS borrow (
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    borrow_due_date DATE NOT NULL,
    borrow_return_date TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_borrow_student
        FOREIGN KEY (student_id)
        REFERENCES students(student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- insert statement #1: insert student
INSERT INTO students (student_first_name, student_last_name, student_course) VALUES
    ('MC FRANCIS', 'ANCLA', 'BSIT'),
    ('MAKMAK', 'ESTOQUE', 'BSED'),
    ('MAKIE', 'ANCLA', 'BSBA');

-- insert statement #2: insert book
INSERT INTO books (book_title, book_author, book_category) VALUES
    ('The Great Gatsby', 'F. Scott Fitzgerald', 'Classic Novel'),
    ('Pride and Prejudice', 'Jane Austen', 'Classic Romance'),
    ('The Hobbit', 'J.R.R. Tolkien', 'Fantasy');

-- insert statement #3: insert borrow
INSERT INTO borrow (student_id, book_id) VALUES
    (1, 2),
    (2, 1),
    (3, 3);
