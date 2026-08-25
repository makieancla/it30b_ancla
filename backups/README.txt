<<<<<<< HEAD
CREATE DATABASES < databases_name.;
show databases;
connect <databases_name>;
CREATE TABLE <table_name_in_plural> (
INSERT INTO <table_name_in_plural>
            (column) Values
            (Values);

);



#Utility Commands
\! cls

mysqldump -u root -p --databases library_makie > C:\xampp\htdocs\dev\backups\081826_library_makie.sql

CREATE DATABASES < databases_name.;
show databases;
connect <databases_name>;
CREATE TABLE <table_name_in_plural> (
INSERT INTO <table_name_in_plural>
            (column) Values
            (Values);

);

 

#Utility Commands
\! cls

source C:\xampp\htdocs\dev\it30b_ancla\backups\library_db_20260820_2026-08-20.sql

mysqldump -u root -p --databases library_makie > "C:\xampp\htdocs\dev\it30b_ancla\backups\library_db_20260820_%date:~10,4%-%date:~4,2%-%date:~7,2%.sql"

ALTER TABLE students ADD COLUMN student_created_at TIMESTAMP NULL DEFAULT NULL;

INSERT INTO students(student_first_name, student_last_name, student_course)
VALUES ("MAKIE", "ANCLA", "BSBA");

UPDATE students set student_created_At = CURRENT_TIMESTAMP WHERE student_created_at IS NULL; 

ALTER TABLE students MODIFY COLUMN student_create_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE books(
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_title VARCHAR (100) NOT NULL,
    book_author VARCHAR (100) NOT NULL,
    book_category VARCHAR (50) NOT NULL,
    book_created_at TIMEStAMP NOT NULL DEFAULT CURRENT_TIMESTAMP); 


MariaDB [library_makie]> INSERT INTO books(book_title,book_author,book_category) VALUES
    -> ("Lord of the Ring","JR Tolkien","Fantasy"),
    -> ("Jurrasic","Micheal Crichton","Science Fiction"),
    -> ("1984","George Orwell","Science FIction");

    CREATE TABLE borrow(
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE borrow(
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    borrow_return_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_borrow_student
        FOREIGN KEY (student_id) REFERENCES students(student_id),
    CONSTRAINT fk_borrow_book
        FOREIGN KEY (book_id) REFERENCES books(book_id)
);

MariaDB [library_makie]> SELECT
    ->     br.borrow_id,
    ->     CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
    ->     s.student_course,
    ->     b.book_title,
    ->     b.book_author,
    ->     b.book_category,
    ->     br.borrow_date
    -> FROM borrow br
    -> JOIN students s ON br.student_id = s.student_id
    -> JOIN books b ON br.book_id = b.book_id
    -> ORDER BY br.borrow_date DESC;

MariaDB [library_makie]> INSERT INTO borrow(student_id,book_id) VALUES
    -> (1,1),
    -> (1,2),
    -> (3,2);