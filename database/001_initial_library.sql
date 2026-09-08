-- #1 students table
CREATE TABLE IF NOT EXIST students (
    -- Primary key for the student table
    student_id INT PRIMARY KEY AUTO_INCREMENT,

    -- student name 
    student_first_name VARCHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,

    -- student course 
    student_course VARCHAR(50) NOT NULL,

    -- student created at timestamp
    student_created_at TIMESTAMP NOT NULL 
    DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4;
COLLATE=utf8mb4_unicode_ci;

-- #2 books table
CREATE TABLE IF NOT EXIST books (
    -- Primary key for the books table
    book_id INT PRIMARY KEY AUTO_INCREMENT,

    -- book details 
    book_title VARCHAR(100) NOT NULL,
    book_author VARCHAR(100) NOT NULL,
    book_category VARCHAR(50) NOT NULL,

    -- book created at timestamp
    book_created_at TIMESTAMP NOT NULL 
        DEFAULT CURRENT_TIMESTAMP


) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4;
COLLATE=utf8mb4_unicode_ci;

-- #3 borrow table
CREATE TABLE IF NOT EXIST borrow (
    --Primary key for the borrow table
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,

    -- foreign key reference
    student_id INT NOT NULL,
    book_id INT NOT NULL,

    --borrow timestamp  not null by default
    borrow_date TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP,

    -- borrow return timestamp  null by default
    borrow_return_date TIMESTAMP NULL
        DEFAULT NULL,
        
    -- borrow table constraints and foreign keys
    CONSTRAINT fk-borrow_student
        FOREIGN KEY (student_id)
        REFERENCES students(student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT


) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4;
COLLATE=utf8mb4_unicode_ci;
