<?php
session_start();
include 'functions/auth_functions.php';
include 'functions/student_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = authenticateUser($username, $password);

  if ($user) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['studentid'] = $user['studentid'];

    if($user['role'] == 'student') {
      header("Location: student_view.php");
      exit();
    } else {
      header("Location: students_manager.php");
      exit();
    }
  } else {
    $login_error = "Invalid username or password.";
  }
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
  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .login-container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      color: #333;
    }

    .table-container {
      background: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-left: 20px;
    }

    .table th,
    .table td {
      color: #333;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-5 login-container">
        <h2 class="text-center">Login</h2>
        <?php if (isset($login_error)) {
          echo '<div class="alert alert-danger">' . $login_error . '</div>';
        } ?>
        <form method="post" action="">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
      </div>
      <div class="col-md-6 table-container">
        <h2 class="text-center">Top 3 Students with Highest GPA</h2>
        <?php
        if ($top_students->num_rows > 0) {
          echo '<table class="table table-striped mt-3"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Class</th><th>GPA</th></tr></thead><tbody>';
          while ($row = $top_students->fetch_assoc()) {
            $rounded_gpa = number_format($row['GPA'], 2);
            echo '<tr>
                    <td>' . $row['MaSV'] . '</td>
                    <td>' . $row['HoTen'] . '</td>
                    <td>' . $row['MaLop'] . '</td>
                    <td>' . $rounded_gpa . '</td>
                </tr>';
          }
          echo '</tbody></table>';
        } else {
          echo '<p>No students found.</p>';
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>