<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';

$role = $_SESSION['role'];

?>

<div class="container">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <?php if ($role == 'admin') { ?>
        <button onclick="window.location.href='gpa_manager.php'">GPA manager</button>
        <button onclick="window.location.href='students_manager.php'">Students manager</button>
        <button onclick="window.location.href='classes.php'">Classes</button>
    <?php } else { ?>
        <button onclick="window.location.href='view_gpa.php'">View GPA</button>
        <button onclick="window.location.href='classmates.php'">View Classmates</button>
    <?php } ?>
</div>

<?php include 'templates/footer.php'; ?>