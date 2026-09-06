<?php
include "config.php";

// Borrow Book
if (isset($_POST['borrow'])) {

    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];

    $sql = "INSERT INTO borrow (student_id, book_id, borrow_date, borrow_due_date)
            VALUES ('$student_id', '$book_id', NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY))";

    $conn->query($sql);

    echo "Book borrowed successfully!";
}


// Delete Borrow Record
if (isset($_POST['delete'])) {

    $borrow_id = $_POST['borrow_id'];

    $sql = "DELETE FROM borrow WHERE borrow_id = '$borrow_id'";

    $conn->query($sql);

    echo "Borrow record deleted!";
}


// Return Book
if (isset($_POST['return'])) {

    $borrow_id = $_POST['borrow_id'];

    $sql = "UPDATE borrow
            SET borrow_return_date = NOW()
            WHERE borrow_id = '$borrow_id'";

    $conn->query($sql);

    echo "Book returned successfully!";
}

?>


<h2>Borrow Book</h2>

<form method="POST">

    <select name="student_id" required>

        <option value="" selected>Select student</option>

        <?php
        $students = $conn->query("SELECT * FROM students");

        while ($student = $students->fetch_assoc()) {
            ?>

            <option value="<?php echo $student['student_id']; ?>">
                <?php
                echo $student['student_first_name'] . " " .
                    $student['student_last_name'];
                ?>
            </option>

        <?php } ?>

    </select>


    <select name="book_id" required>

        <option value="" selected>Select book</option>

        <?php
        $books = $conn->query("SELECT * FROM books");

        while ($book = $books->fetch_assoc()) {
            ?>

            <option value="<?php echo $book['book_id']; ?>">
                <?php echo $book['book_title']; ?>
            </option>

        <?php } ?>

    </select>

    <button type="submit" name="borrow">
        Borrow Book
    </button>

</form>


<h2>Return Book</h2>

<?php

$result = $conn->query("
    SELECT borrow.*, students.student_first_name,
    students.student_last_name, books.book_title
    FROM borrow
    JOIN students
    ON borrow.student_id = students.student_id
    JOIN books
    ON borrow.book_id = books.book_id
    WHERE borrow.borrow_return_date IS NULL
");

while ($row = $result->fetch_assoc()) {
    ?>

    <p>
        <?php
        echo $row['student_first_name'] . " " .
            $row['student_last_name'] .
            " - " .
            $row['book_title'];
        ?>
    </p>

    <form method="POST">

        <input type="hidden" name="borrow_id" value="<?php echo $row['borrow_id']; ?>">

        <button type="submit" name="return">
            Return Book
        </button>

    </form>

<?php } ?>


<h2>Currently Borrowed Books</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Student</th>
        <th>Book</th>
        <th>Borrowed On</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    $result = $conn->query("
        SELECT borrow.*, students.student_first_name,
        students.student_last_name, books.book_title, books.book_author
        FROM borrow
        JOIN students ON borrow.student_id = students.student_id
        JOIN books ON borrow.book_id = books.book_id
    ");

    while ($row = $result->fetch_assoc()) {
        if ($row['borrow_return_date'] !== NULL) {
            $status = 'Returned';
        } elseif (strtotime($row['borrow_due_date']) < time()) {
            $status = 'Overdue';
        } else {
            $status = 'Borrowed';
        }
        ?>
        <tr>
            <td><?php echo $row['student_first_name'] . " " . $row['student_last_name']; ?></td>
            <td><?php echo $row['book_title'] . " by " . $row['book_author']; ?></td>
            <td><?php echo date('Y-m-d', strtotime($row['borrow_date'])); ?></td>
            <td><?php echo date('Y-m-d', strtotime($row['borrow_due_date'])); ?></td>
            <td><?php echo $status; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="borrow_id" value="<?php echo $row['borrow_id']; ?>">
                    <button type="submit" name="delete" onclick="return confirm('Delete this record?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>