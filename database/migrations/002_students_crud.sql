-- student SQL#1 : select a students
SELECT * FROM students;

-- student SQL#2 : select a student in asc order
SELECT * FROM students 
    ORDER BY student_id ASC;

 -- student SQL#3 : select a student in desc order
SELECT * FROM students 
    ORDER BY student_id DESC;

 -- student SQL#4 : select a student in asc order
SELECT * FROM students 
    ORDER BY student_last_name ASC;

 -- student SQL#5: select a student in desc order
SELECT * FROM students 
    ORDER BY student_last_name DESC;

 -- student SQL#6: select a student in asc order
SELECT * FROM students 
    ORDER BY student_first_name ASC;

 -- student SQL#7: select a student in desc order
SELECT * FROM students 
    ORDER BY student_first_name DESC;

--you can modify displayed columns by selecting
--specific columns after SELECT command
-- student SQL#8 display all student first_name and last_name
SELECT student_first_name,
       student_last_name
FROM students
ORDER BY student_first_name ASC;

-- student SQL#9 LIMIT 1 - you can chane the limit to any number
SELECT student_first_name,
       student_last_name
FROM students
ORDER BY student_first_name ASC
LIMIT 1;

-- student SQL#10 LIMIT 1 - Select a student base on id
SELECT student_first_name,
       student_last_name
FROM students
WHERE student_id = 1
LIMIT 1;

-- student SQL#11 - Update a student base on id
UPDATE students
SET student_first_name = 'MC FRANCIS',
    student_last_name = 'ANCLA'
WHERE student_id = 2;

UPDATE books
set book_title = '',
    book_author = ''
WHERE book_id = 1;