<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'student') {
  header("Location: login.php");
  exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';

$student_id = $_SESSION['studentid'];
$gpa = getStudentGPA($student_id);

?>

<div class="container">
  <h2>Your GPA</h2>
  <p>Your GPA is: <?php echo $gpa; ?></p>
</div>

<?php include 'templates/footer.php'; ?>