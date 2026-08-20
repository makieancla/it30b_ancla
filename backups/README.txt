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
=======
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

mysqldump -u root -p --databases library_makie > "C:\xampp\htdocs\dev\backups\library_db_20260820_%date:~10,4%-%date:~4,2%-%date:~7,2%.sql"

ALTER TABLE students ADD COLUMN student_created_at TIMESTAMP NULL DEFAULT NULL;

INSERT INTO students(student_first_name, student_last_name, student_course)
VALUES ("MAKIE", "ANCLA", "BSBA");

UPDATE students set student_created_At = CURRENT_TIMESTAMP WHERE student_created_at IS NULL;

ALTER TABLE students MODIFY COLUMN student_create_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
>>>>>>> feature/01-use-cases
