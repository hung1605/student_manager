<?php
// include 'templates/header.php';
include 'functions/student_functions.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // For now, accept any username/password
  $_SESSION['loggedin'] = true;
  header("Location: index.php");
  exit();
}

$top_students = getTopStudents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mt-5">Login</h2>
        <form method="post" action="">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>

    <h2 class="mt-5">Top 3 Students with Highest GPA</h2>

    <?php
    if ($top_students->num_rows > 0) {
      echo '<table class="table table-striped mt-3"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Class</th><th>GPA</th></tr></thead><tbody>';
      while ($row = $top_students->fetch_assoc()) {
        echo '<tr>
              <td>' . $row['MaSV'] . '</td>
              <td>' . $row['HoTen'] . '</td>
              <td>' . $row['MaLop'] . '</td>
              <td>' . $row['GPA'] . '</td>
            </tr>';
      }
      echo '</tbody></table>';
    } else {
      echo '<p>No students found.</p>';
    }
    ?>
  </div>

  <!-- <?php include 'templates/footer.php'; ?> -->
</body>

</html>