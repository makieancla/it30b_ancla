
<?php
// DATABASE CONNECTION
$host = 'localhost';
$db = 'it30b_lab_db';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ---------- KPI COUNTS ----------
$studentCount = $pdo->query(
    "SELECT COUNT(*) FROM students"
)->fetchColumn();

$bookCount = $pdo->query(
    "SELECT COUNT(*) FROM books"
)->fetchColumn();

$totalBorrows = $pdo->query(
    "SELECT COUNT(*) FROM borrow"
)->fetchColumn();

$activeBorrows = $pdo->query(
    "SELECT COUNT(*) FROM borrow
     WHERE borrow_return_date IS NULL"
)->fetchColumn();

// ---------- BOOKS BY CATEGORY ----------
$catStmt = $pdo->query("
    SELECT book_category, COUNT(*) AS cnt
    FROM books
    GROUP BY book_category
    ORDER BY cnt DESC
");

$categories = [];
$categoryCounts = [];

while ($row = $catStmt->fetch()) {
    $categories[] = $row['book_category'];
    $categoryCounts[] = (int) $row['cnt'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Library | Dashboard</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            font-family: Roboto, system-ui, sans-serif;
            color: #212121;
            padding: 2rem 1.5rem;
        }

        .dashboard {
            max-width: 1300px;
            width: 100%;
            margin: auto;
        }

        /* KPI CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card,
        .chart-card {
            background: #fff;
            border-radius: 6px;
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.12);
            transition: 0.3s;
        }

        .stat-card:hover,
        .chart-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-card {
            border-top: 3px solid #1976d2;
        }

        .stat-card:nth-child(2) {
            border-top-color: #4caf50;
        }

        .stat-card:nth-child(3) {
            border-top-color: #ff9800;
        }

        .stat-card:nth-child(4) {
            border-top-color: #f44336;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.7rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #757575;
            text-transform: uppercase;
            font-weight: 500;
        }

        .stat-header .material-icons {
            font-size: 1.8rem;
            color: #bdbdbd;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .stat-sub {
            font-size: 0.85rem;
            color: #9e9e9e;
            margin-top: 0.3rem;
        }

        /* CHARTS */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #e0e0e0;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chart-title span {
            color: #1976d2;
            font-size: 0.75rem;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .chart-title .material-icons {
            font-size: 1rem;
        }

        .chart-container {
            position: relative;
            height: 260px;
        }

        .footer-note {
            text-align: center;
            margin-top: 2rem;
            color: #9e9e9e;
            font-size: 0.8rem;
        }

        @media(max-width: 900px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            body {
                padding: 1rem;
            }

            .stats-grid,
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="dashboard">

    <!-- NAVIGATION -->
    <?php include 'includes/navbar.php'; ?>

    <!-- KPI CARDS -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Students</span>
                <span class="material-icons">school</span>
            </div>
            <div class="stat-number">
                <?= $studentCount ?>
            </div>
            <div class="stat-sub">Enrolled students</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Books</span>
                <span class="material-icons">auto_stories</span>
            </div>
            <div class="stat-number">
                <?= $bookCount ?>
            </div>
            <div class="stat-sub">Books in collection</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Borrow Records</span>
                <span class="material-icons">history</span>
            </div>
            <div class="stat-number">
                <?= $totalBorrows ?>
            </div>
            <div class="stat-sub">All time records</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Active Loans</span>
                <span class="material-icons">pending_actions</span>
            </div>
            <div class="stat-number">
                <?= $activeBorrows ?>
            </div>
            <div class="stat-sub">Not yet returned</div>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="charts-grid">

        <div class="chart-card">
            <div class="chart-title">
                Books by Category

                <span>
                    <span class="material-icons">category</span>
                    Collection
                </span>
            </div>

            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

    </div>

    <div class="footer-note">
        Library Management System | Dashboard
    </div>

</div>

<script>
(function() {

    const colors = [
        '#1976d2',
        '#4caf50',
        '#ff9800',
        '#f44336',
        '#9c27b0',
        '#9e9e9e'
    ];

    const categoryLabels = <?= json_encode($categories) ?>;
    const categoryData = <?= json_encode($categoryCounts) ?>;

    const ctx = document.getElementById('categoryChart');

    new Chart(ctx, {
        type: 'doughnut',

        data: {
            labels: categoryLabels,

            datasets: [{
                data: categoryData,
                backgroundColor: colors,
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 5
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',

            plugins: {
                legend: {
                    position: 'bottom',

                    labels: {
                        padding: 16,
                        boxWidth: 12,
                        font: {
                            size: 12
                        }
                    }
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;

                            const total = context.dataset.data.reduce(
                                (a, b) => a + b, 0
                            );

                            const percentage = total > 0
                                ? ((value / total) * 100).toFixed(0)
                                : 0;

                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

})();
</script>

</body>
</html>
