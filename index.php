<?php
// Database connection
$host = 'localhost';
$db = 'it30b_lab_db';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try{
    $pdo = new PDO($dsn, $user, $password, $options);
    echo 'connection successful';
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
//s Session
session_start();

// Determine current section
$section = $_GET['section'] ?? 'students'; 

//determine crud operation
$action = $_GET['action'] ?? '';

// Fetch Studenta
if($section==='students'){

$stmt = $pdo->query("
        SELECT *
        FROM students
        ORDER BY student_id DESC
");

    $students = $stmt->fetchAll();
}

//Create student
if ($section=='students' && $action==='create'){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $firstname = trim($_POST['student_first_name']?? '');
        $lastname = trim($_POST['student_last_name']?? '');
        $course = trim($_POST['student_course']?? '');

        if($firstname !== '' && $lastname !=='' && $course!== ''){
            $sql = "
                INSERT INTO students(
                    student_first_name,
                    student_last_name,
                    student_course
                )
                VALUES (?,?,?)
            ";
            
            $stmt=$pdo->prepare($sql);

            $stmt->execute([
                $firstname,
                $lastname,
                $course
            ]);

            header("Location: index.php?section=students");
            exit;
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System</title>
</head>
<body>
    <h1>Simple Library System</h1>
</nav>
    <a href="index.php?section=students">Students</a> |
    <a href="index.php?section=books">Books</a> |
    <a href="index.php?section=borrow">Borrow</a> |
</nav>
<hr>
<?php if ($section === 'students'): ?>
    <h1>Students</h1>

    <p>
        <a href="index.php?section=students&action=create">
            Add Student
        </a>
    </p>

    <?php if ($action=='create'): ?>
    <h2>Create Student<h2>
    <form method="POST">
    <p>
            <label>First Name:</label>
            <br>
            <input type="text"
                    name="student_first_name"
                    required
            />
        </p>  
    <p>
            <label>Last Name:</label>
            <br>
            <input type="text"
                    name="student_last_name"
                    required
            />
        </p>
    <p>
            <label>Course:</label>
            <br>
            <input type="text"
                    name="student_course"
                    required
            />
        </p>


        <button type="submit">
            save
        </button>

        <a href="index.php?section=students">
            Cancel
        </a>
</form>
    

    <?php else: ?>
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Course</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td>
                        <?=htmlspecialchars($student['student_id']) ?>
                    </td>
                    <td>
                        <?=htmlspecialchars($student['student_first_name']) ?>
                    </td>
                    <td>
                        <?=htmlspecialchars($student['student_last_name']) ?>
                    </td>
                    <td>
                        <?=htmlspecialchars($student['student_course']) ?>
                    </td>
                    <td>
                        <?=htmlspecialchars($student['student_created_at']) ?>
                    </td>
                    <td>
                        <a>Edit</a>
                        |
                        <a>Delete</a>
                    
                    </td>
                    
                </tr>
            <?php endforeach?>
        </tbody>
        <?php endif;?>
    </table>
    <?php endif; ?>


<?php if ($section === 'books'): ?>
    <h1>Books</h1>
<?php endif;?>

<?php if ($section === 'borrow'): ?>
    <h1>Borrow</h1>
<?php endif;?>


</body>
</html>