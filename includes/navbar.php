
<?php
$currentSection = $_GET['section'] ?? 'dashboard';

function navActive($section, $currentSection) {
    return $section === $currentSection ? 'active' : '';
}
?>

<style>
.app-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
}

.app-header h1 {
    font-weight: 400;
    font-size: 1.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #212121;
}

.app-header h1 .material-icons {
    font-size: 2.2rem;
    color: #1976d2;
}

.nav-links {
    display: flex;
    gap: 0.25rem;
}

.nav-links a {
    text-decoration: none;
    color: #616161;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    padding: 0.6rem 1rem;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 0.35rem;
    transition: 0.2s;
}

.nav-links a:hover {
    background: #e3f2fd;
    color: #1976d2;
}

.nav-links a.active {
    color: #1976d2;
    background: #e3f2fd;
}

.nav-links a .material-icons {
    font-size: 1.2rem;
}

@media(max-width: 760px) {
    .app-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-links {
        width: 100%;
        overflow-x: auto;
    }

    .nav-links a {
        white-space: nowrap;
        padding: 0.5rem 0.8rem;
    }
}
</style>

<header class="app-header">

    <h1>
        <span class="material-icons">local_library</span>
        Library Dashboard
    </h1>

    <nav class="nav-links">

        <a href="dashboard.php?section=dashboard"
        class="<?= navActive('dashboard', $currentSection) ?>">
            <span class="material-icons">dashboard</span>
            Dashboard
        </a>

        <a href="index.php?section=students"
        class="<?= navActive('students', $currentSection) ?>">
            <span class="material-icons">people</span>
            Students
        </a>

        <a href="index.php?section=books"
        class="<?= navActive('books', $currentSection) ?>">
            <span class="material-icons">menu_book</span>
            Books
        </a>

        <a href="index.php?section=borrow"
        class="<?= navActive('borrow', $currentSection) ?>">
            <span class="material-icons">swap_horiz</span>
            Borrow
        </a>

    </nav>

</header>
