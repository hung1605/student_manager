<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'templates/header.php'; ?>

<h2>Welcome to the Student Management System</h2>
<p>Use the navigation links to manage students or view top students.</p>

<?php include 'templates/footer.php'; ?>
