<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'student') {
  header("Location: login.php");
  exit();
}

include 'templates/header.php';
include 'functions/student_functions.php';

$student_id = $_SESSION['studentid'];
$classmates = getClassmates($student_id);

?>

<div class="container">
  <h2>Your Classmates</h2>
  <?php
  if ($classmates->num_rows > 0) {
    echo '<table class="table table-striped mt-3"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>DOB</th><th>Address</th></tr></thead><tbody>';
    while ($row = $classmates->fetch_assoc()) {
      echo '<tr>
                <td>' . $row['MaSV'] . '</td>
                <td>' . $row['HoTen'] . '</td>
                <td>' . $row['NgaySinh'] . '</td>
                <td>' . $row['DiaChi'] . '</td>
            </tr>';
    }
    echo '</tbody></table>';
  } else {
    echo '<p>No classmates found.</p>';
  }
  ?>
</div>

<?php include 'templates/footer.php'; ?>