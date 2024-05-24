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
$classmates = getClassmates($student_id);
?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title noi-bat">Your GPA</h2>
        </div>
        <div class="card-body">
          <p class="card-text noi-bat">Your GPA is: <?php echo (int)$gpa; ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title noi-bat">Your Classmates</h2>
        </div>
        <div class="card-body">
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
      </div>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>