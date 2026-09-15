SELECT
    br.borrow_id,

    -- student Full Name
    CONCAT(
        s.student_first_name, 
        ' ',
        s.student_last_name
    ) AS student_name,

    -- books
    b.book_title,
    b.book_author,
    b.book_category,

    -- borrow date
    br.borrow_date

FROM borrow br

INNER JOIN students s
    ON br.student_id = s.student_id

INNER JOIN books b
    ON br.book_id = b.book_id

WHERE br.borrow_return_date IS NULL

ORDER BY br.borrow_date DESC;

-- return a book
UPDATE borrow
SET borrow_return_date = CURRENT_TIMESTAMP
WHERE borrow_id = 1
  AND borrow_return_date IS NULL;

-- view returned books
SELECT
    br.borrow_id,

    -- student Full Name
    CONCAT(
        s.student_first_name, 
        ' ',
        s.student_last_name
    ) AS student_name,

    -- books
    b.book_title,
    b.book_author,
    b.book_category,

    -- borrow date
    br.borrow_date

FROM borrow br

INNER JOIN students s
    ON br.student_id = s.student_id

INNER JOIN books b
    ON br.book_id = b.book_id

WHERE br.borrow_return_date IS NOT NULL

ORDER BY br.borrow_date DESC;
