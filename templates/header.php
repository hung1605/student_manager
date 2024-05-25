<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management System</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      font-family: Arial, sans-serif;
    }

    header {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    nav a {
      color: #fff;
      text-decoration: none;
      margin-right: 20px;
    }

    nav a:hover {
      color: #ccc;
    }

    h1 {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin: 0;
      font-size: 36px;
    }

    .noi-bat {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      margin: 0;
    }
  </style>


</head>

<body>
  <header class="mt-3">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Student Management System</h1>
      <nav>
        <?php if ($_SESSION['role'] == 'admin') : ?>
          <a href="students_manager.php" class="btn btn-link">Students Management</a>
          <a href="classes.php" class="btn btn-link">Classes</a>
        <?php else : ?>
          <a href="student_view.php" class="btn btn-link">Student Dashboard</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-link">Logout</a>
      </nav>
    </div>
  </header>
  <hr>